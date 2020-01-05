<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Eventviva\ImageResize;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        return view('web.site.index');
    }
    
    public function registerRequest($token, Request $request)
    {
        $user = \App\User::where('registered_token', $token)
                ->roleMobileApp()
                ->first();
        if (!$user) {
            abort(404, 'Page is not found.');
        }
        
        if ($user->gender == \App\User::GENDER_MALE) {
            $relation = $user->userRelation->femaleUser;
        } else {
            $relation = $user->userRelation->maleUser;
        }
        
        $webRealUrl = url('register-relation/' . $token);
        $iosUrlScheme = $androidUrlScheme = 'agendanikah://register-relation?token=' . $token;
        
        return view('web.site.register-request', compact('user', 'relation', 'webRealUrl', 'iosUrlScheme', 'androidUrlScheme'));
    }
    
    public function proccessRegisterRequest(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'registered_token' => 'required|exists:user,registered_token',
            'phone' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);
        
        $user = \App\User::where('registered_token', $request->registered_token)
                ->roleMobileApp()
                ->first();
        if (!$user) {
            abort(404, 'Page is not found.');
        }
        
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->status = \App\User::STATUS_ACTIVE;
        $user->registered_token = null;
        $user->save();
        
        $user->sendRegisterNotification();
        
        \Session::flash('success', 'Registrasi telah sukses, Silahkan Anda menggunakan Akun ini untuk masuk ke Aplikasi ' . config('app.name') . '. (Available on the App Store)');
        
        return redirect('success');
    }
    
    public function resetPassword($token, Request $request)
    {
        if ($token == null) {
            abort(404, 'Page is not found.');
        }
        
        $user = \App\User::where('forgot_token', $token)
                ->roleMobileApp()
                ->first();
        if (!$user) {
            abort(404, 'Page is not found.');
        }

        
        $webRealUrl = url('reset-your-password/' . $token);
        $iosUrlScheme = $androidUrlScheme = 'agendanikah://reset-password?token=' . $token;
        
        return view('web.site.reset-password', compact('user', 'relation', 'webRealUrl', 'iosUrlScheme', 'androidUrlScheme'));
    }
    
    public function proccessResetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);
        
        $user = \App\User::where('forgot_token', $request->forgot_token)
                ->roleMobileApp()
                ->first();
        if (!$user) {
            abort(404, 'Page is not found.');
        }
        
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->forgot_token = null;
        $user->save();
        
        \Session::flash('success', 'Reset Password Sukses');
        
        return redirect('success');
    }

    public function transactionConfirmation($token, Request $request)
    {
        if ($token == null) {
            abort(404, 'Page is not found.');
        }

        $token = base64_decode($token);
        
        $transaction = \App\Transaction::where('code', $token)
                ->first();
        if (!$transaction) {
            abort(404, 'Page is not found.');
        }

        
        $webRealUrl = url('transaction-confirmation/' . $token);
        $iosUrlScheme = $androidUrlScheme = 'agendanikah://transaction-confirmation?token=' . $token;
        
        return view('web.site.transaction-confirmation', compact('transaction', 'relation', 'webRealUrl', 'iosUrlScheme', 'androidUrlScheme'));
    }
    
    public function proccessTransactionConfirmation(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|min:1|max:50000|image',
            'bank_id' => 'required',
            'user_bank_account_name' => 'required',
            'user_account_holder' => 'required',
            'user_account_number' => 'required',
            'total' => 'required',
        ]);

        $transaction = \App\Transaction::where('code', $request->code)
                ->first();
        
        if (!$transaction) {
            abort(404, 'Page is not found.');
        }
        $transaction->status = \App\Transaction::STATUS_CONFIRMED;
        $transaction->save();

        $model = new \App\TransactionPayment;
        $model->fill($request->all());
        $model->user_id = $transaction->user_id;
        $model->transaction_id = $transaction->id;
        if (isset($request->file)) {
			$files = $request->file('file');
			$filename = $model->generateFilename($files->getClientOriginalExtension());
			$files->move($model->getPath(), $filename);
            $img = new ImageResize($model->getPath() . $filename);
            $img->resizeToWidth(1280);
            $img->save($model->getPath() . $filename);
            $model->file = $filename;
        }
        $model->save();
        $model->sendPaymentConfirmationNotification();
        
        \Session::flash('success', 'Konfirmasi Sukses');
        
        return redirect('success');
    }
    
    public function success(Request $request)
    {
        return view('web.site.success');
    }
    
    public function support(Request $reqeust)
    {
        return view('web.site.support');
    }
}
