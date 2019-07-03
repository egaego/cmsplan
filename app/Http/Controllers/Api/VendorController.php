<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Vendor;
use App\Concept;
use App\User;
use App\UserFavoriteVendor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;

class VendorController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function concept(Request $request)
    {
        $vendors = Concept::actived()->ordered()->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $vendors
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function list($conceptId, Request $request)
    {
        if ($request->has('token')) {
            $user = JWTAuth::parseToken()->authenticate();
        } else {
            $user = new User();
        }

        $models = Vendor::actived()->ordered()->where('concept_id', $conceptId)->get();

        $result = [];
        foreach ($models as $key => $model) {
            $gallery = UserFavoriteVendor::where('user_id', $user->id)
                ->where('vendor_id', $model->id)
                ->first();
            $result[$key] = $model;
            $result[$key]['is_favorite'] = !$gallery ? 0 : 1;
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $result
        ], 200);
    }

    public function store($vendorId, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $user = User::whereId($user->id)->roleMobileApp()->first();
        if (!$user) {
            return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
        }
        
        $userGallery = new UserFavoriteVendor();
        $userGallery->user_id = $user->id;
        $userGallery->vendor_id = $vendorId;
        $userGallery->save();
        
        return response()->json([
            'status' => 201,
            'message' => 'Success',
        ], 201);
    }

    public function delete($vendorId, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $user = User::whereId($user->id)->roleMobileApp()->first();
        if (!$user) {
            return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
        }
        
        $model = UserFavoriteVendor::where('user_id', $user->id)
            ->where('vendor_id', $vendorId)->first();
        if ($model) {
            $model->delete();
        }
        
        return response()->json([
            'status' => 201,
            'message' => 'Remove Success'
        ], 201);
    }

    /**
     * @param type $id = concept_id
     * @param Request $request
     * @return type
     */
    public function userVendors(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $user = User::whereId($user->id)->roleMobileApp()->first();
        if (!$user) {
            return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
        }

        $models = Vendor::select(['vendor.*'])->join('user_favorite_vendor', 'user_favorite_vendor.vendor_id', '=', 'vendor.id')
            ->where('user_favorite_vendor.user_id', $user->id)
            ->orderBy('user_favorite_vendor.created_at', 'DESC')
            ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $models
        ], 200);
    }
}
