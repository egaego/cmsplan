<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VendorPackage;
use DB;
use Eventviva\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class VendorPackageController extends Controller
{
	protected $rules = [
		'name' => 'required',
		'status' => 'required',
        'description' => 'required',
        'price' => 'required',
	];


	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.vendor-package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create($vendorId)
    {
        $vendor = \App\Vendor::find($vendorId);
        
        return view('admin.vendor-package.create', compact('vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store($vendorId, Request $request)
    {
        $this->validate($request, $this->rules);
		
		$model = new VendorPackage();
		$requestData = $request->all();
		$model->fill($requestData);
        $model->vendor_id = $vendorId;
		$model->save();
        
        Session::flash('success', 'VendorPackage added!');
        
        return redirect(route('vendor.show', ['id' => $model->vendor_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *Bank
     * @return View
     */
    public function show($id)
    {
        $model = VendorPackage::findOrFail($id);

        return view('admin.vendor-package.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return View
     */
    public function edit($id)
    {
        $model = VendorPackage::findOrFail($id);

        return view('admin.vendor-package.edit', compact('model'));
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
		$rules = $this->rules;
        $this->validate($request, $rules);
		
		$model = VendorPackage::findOrFail($id);
		
        $requestData = $request->all();
		
		$model->fill($requestData);
		$model->save();
		
        Session::flash('success', 'VendorPackage updated!');

        return redirect(route('vendor.show', ['id' => $model->vendor_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $model = VendorPackage::findOrFail($id);
        $model->delete();
        
        Session::flash('success', 'VendorPackage deleted!');

        return redirect('admin/vendor-package');
    }
	
	/**
	 * any data
	 */
	public function listIndex($id, Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = VendorPackage::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'vendor_package.*'
				])
                ->where('vendor_id', $id);

         $datatables = app('datatables')->of($model)
            ->editColumn('status', function ($model) {
                return $model->getStatusLabel();
            })
            ->addColumn('action', function ($model) {
                return '<a href="'.route('vendor-package.edit', ['id'=>$model->id]).'" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> '
						. '<a onclick="modalDelete('.$model->id.')" href="javascript:;" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash"></i></a>';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

//        if ($range = $datatables->request->get('range')) {
//            $rang = explode(":", $range);
//            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
//                $datatables->whereBetween('vendor-package.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
//                $datatables->whereBetween('vendor-package.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }
//        }
		
        return $datatables->make(true);
    }
}
