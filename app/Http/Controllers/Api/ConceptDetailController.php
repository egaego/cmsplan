<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\FormatConverter;
use App\ConceptDetail;
use App\Concept;
use App\User;
use App\UserFavoriteVendor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;

class ConceptDetailController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
        }
        
        $models = ConceptDetail::with(['vendor', 'concept'])->where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')->get();

        $total = 0;
        foreach ($models as $model) {
            $total += $model->vendor ? $model->vendor->price : 0;
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'total' => $total,
            'data' => $models
        ], 200);
    }

    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
        }
        
        $validator = \Validator::make($request->all(), [
			'concept_id' => 'required',
            'vendor_id' => 'required',
            'date' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
        }
        
        $model = new ConceptDetail();
        $model->user_id = $user->id;
        $model->concept_id = $request->concept_id;
        $model->vendor_id = $request->vendor_id;
        $model->date = $request->date;
        $model->save();

        $models = ConceptDetail::with(['vendor', 'concept'])->where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')->get();
        $total = 0;
        foreach ($models as $model) {
            $total += $model->vendor ? $model->vendor->price : 0;
        }
        
        return response()->json([
            'status' => 201,
            'message' => 'Success',
            'data' => $models,
            'total' => $total
        ], 201);
    }

    public function delete($id, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        ConceptDetail::where('id', $id)->delete();

        $models = ConceptDetail::with(['vendor', 'concept'])->where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')->get();
        $total = 0;
        foreach ($models as $model) {
            $total += $model->vendor ? $model->vendor->price : 0;
        }

        return response()->json([
            'status' => 201,
            'message' => 'Remove Success',
            'data' => $models,
            'total' => $total
        ], 201);
    }
}
