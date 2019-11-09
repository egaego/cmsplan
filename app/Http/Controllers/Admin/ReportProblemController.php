<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ReportProblem;
use DB;
use Eventviva\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class ReportProblemController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.report-problem.index');
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
        $model = ReportProblem::findOrFail($id);
        $model->delete();
        
        Session::flash('success', 'Vendor deleted!');

        return redirect('admin/vendor');
    }
	
	/**
	 * any data
	 */
	public function listIndex(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = ReportProblem::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'report_problem.*'
				]);

         $datatables = app('datatables')->of($model)
            ->editColumn('status', function ($model) {
                return $model->getStatusLabel();
            })
            ->editColumn('user_id', function ($model) {
                return $model->user ? $model->user->name : '';
            })
            ->editColumn('category', function ($model) {
                return $model->getCategoryLabel();
            })
            ->addColumn('action', function ($model) {
                return '<a onclick="modalDelete('.$model->id.')" href="javascript:;" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash"></i></a>';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }
		
        return $datatables->make(true);
    }
}
