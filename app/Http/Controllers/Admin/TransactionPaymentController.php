<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TransactionPayment;
use DB;
use Eventviva\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class TransactionPaymentController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.transaction-payment.index');
    }

    public function show($id)
    {
        $model = Transaction::findOrFail($id);

        return view('admin.transaction-payment.show', compact('model'));
    }

	/**
	 * any data
	 */
	public function listIndex($id, Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = TransactionPayment::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'transaction_payment.*'
                ])
                ->where('transaction_payment.transaction_id', $id);

         $datatables = app('datatables')->of($model)
            ->editColumn('bank_id', function($model) {
                return $model->bank ? $model->bank->name : $model->bank_id;
            })
            ->editColumn('user_id', function($model) {
                return $model->user ? $model->user->name : $model->user_id;
            })
            ->editColumn('total', function($model) {
                return \App\Helpers\FormatConverter::rupiahFormat($model->total, 2);
            })
            ->editColumn('file', function($model) {
                return $model->getFileHtml();
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

//        if ($range = $datatables->request->get('range')) {
//            $rang = explode(":", $range);
//            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
//                $datatables->whereBetween('message.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
//                $datatables->whereBetween('message.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }
//        }
		
        return $datatables->make(true);
    }
}
