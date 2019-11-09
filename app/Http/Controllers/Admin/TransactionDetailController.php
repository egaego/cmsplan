<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TransactionDetail;
use DB;
use Eventviva\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class TransactionDetailController extends Controller
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

	/**
	 * any data
	 */
	public function listIndex($id, Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = TransactionDetail::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'transaction_detail.*'
                ])
                ->where('transaction_detail.transaction_id', $id);

         $datatables = app('datatables')->of($model)
            ->editColumn('concept_id', function($model) {
                return $model->concept ? $model->concept->name : $model->concept_id;
            })
            ->editColumn('vendor_id', function($model) {
                return $model->vendor ? $model->vendor->name : $model->vendor_id;
            })
            ->editColumn('vendor_package_id', function($model) {
                return $model->vendorPackage ? $model->vendorPackage->name : $model->vendor_package_id;
            })
            ->editColumn('vendor_voucher_id', function($model) {
                return $model->vendorVoucher ? $model->vendorVoucher->name : $model->vendor_voucher_id;
            })
            ->editColumn('grand_total', function($model) {
                return \App\Helpers\FormatConverter::rupiahFormat($model->grand_total, 2);
            })
            ->editColumn('total', function($model) {
                return \App\Helpers\FormatConverter::rupiahFormat($model->total, 2);
            })
            ->editColumn('voucher_discount', function($model) {
                return \App\Helpers\FormatConverter::rupiahFormat($model->voucher_discount, 2);
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
