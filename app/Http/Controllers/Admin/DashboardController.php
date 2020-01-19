<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Transaction;
use DB;

class DashboardController extends \App\Http\Controllers\Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function transactionPending(Request $request) {
        DB::statement(DB::raw('set @rownum=0'));
        $model = Transaction::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'transaction.*'
                ])
                ->where('transaction.status', Transaction::STATUS_CONFIRMED);

         $datatables = app('datatables')->of($model)
            ->editColumn('user_id', function($model) {
                return $model->user ? $model->user->name : $model->user_id;
            })
            ->editColumn('bank_id', function($model) {
                return $model->transactionPayments ? $model->transactionPayments[0]->bank ? $model->transactionPayments[0]->bank->name : '' : '';
            })
            ->editColumn('payment_type_id', function($model) {
                return $model->paymentType ? $model->paymentType->name : $model->payment_type_id;
            })
            ->addColumn('vendor', function($model) {
                return $model->transactionDetails ? $model->transactionDetails[0]->vendor ? $model->transactionDetails[0]->vendor->name : '' : '';
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
