<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use DB;
use Eventviva\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class TransactionController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.transaction.index');
    }

    public function show($id)
    {
        $model = Transaction::findOrFail($id);

        return view('admin.transaction.show', compact('model'));
    }

    public function edit($id)
    {
        $model = Transaction::findOrFail($id);

        return view('admin.transaction.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update($id, Request $request)
    {	
		$model = Transaction::findOrFail($id);
		
        $requestData = $request->all();
		
        $model->fill($requestData);
        
        if ($model->status == \App\Transaction::STATUS_SUCCESS) {
            $model->status_payment = \App\Transaction::STATUS_PAYMENT_PAID;
            $model->payment_paid_at = \Carbon\Carbon::now()->toDateTimeString();
        }

		$model->save();
		
        Session::flash('success', 'Transaction updated!');

        return redirect('admin/transaction/'. $model->id);
    }

	/**
	 * any data
	 */
	public function listIndex(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = Transaction::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'transaction.*'
				]);

         $datatables = app('datatables')->of($model)
            ->editColumn('status', function($model) {
                return $model->getStatusLabel();
            })
            ->editColumn('status_payment', function($model) {
                return $model->getStatusPaymentLabel();
            })
            ->editColumn('grand_total', function($model) {
                return \App\Helpers\FormatConverter::rupiahFormat($model->grand_total, 2);
            })
            ->addColumn('action', function ($model) {
                return '<a href="'.route('transaction.show', ['id'=>$model->id]).'" class="btn btn-xs btn-success rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-eye"></i></a> '
						. '<a href="'.route('transaction.edit', ['id'=>$model->id]).'" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> ';
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
