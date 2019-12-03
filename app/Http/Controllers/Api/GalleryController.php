<?php

namespace App\Http\Controllers\Api;

use App\Gallery;
use App\Concept;
use App\UserGallery;
use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class GalleryController extends Controller
{
    /**
     * @param type $id = concept_id
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        if ($request->has('token')) {
            $user = JWTAuth::parseToken()->authenticate();
        } else {
            $user = new User();
        }

        $concept = $request->get('concept_id', null);
        
        $models = Gallery::inRandomOrder()->get();

        if ($concept != null) {
            $models = Gallery::where('concept_id', $concept)->inRandomOrder()->get();
        }

        $result = [];
        foreach ($models as $key => $model) {
            $gallery = UserGallery::where('user_id', $user->id)
                ->where('gallery_id', $model->id)
                ->first();
            $result[$key] = $model;
            $result[$key]['is_favorite'] = !$gallery ? 0 : 1;
            $result[$key]['gallery'] = $user->id;
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $result
        ], 200);
    }

    /**
     * @param type $id = concept_id
     * @param Request $request
     * @return type
     */
    public function galleryConcepts(Request $request)
    {
        if ($request->has('token')) {
            $user = JWTAuth::parseToken()->authenticate();
        } else {
            $user = new User();
        }
        $models = Concept::actived()->inRandomOrder()->limit(3)->get();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $models
        ], 200);
    }
    
    public function store($galleryId, Request $request)
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
        
        $userGallery = new UserGallery();
        $userGallery->user_id = $user->id;
        $userGallery->gallery_id = $galleryId;
        $userGallery->save();
        
        return response()->json([
            'status' => 201,
            'message' => 'Success',
        ], 201);
    }

    public function delete($galleryId, Request $request)
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
        
        $model = UserGallery::where('user_id', $user->id)
            ->where('gallery_id', $galleryId)->first();
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
    public function userGalleries(Request $request)
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

        $models = Gallery::select(['gallery.*'])->join('user_gallery', 'user_gallery.gallery_id', '=', 'gallery.id')
            ->where('user_gallery.user_id', $user->id)
            ->orderBy('user_gallery.created_at', 'DESC')
            ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $models
        ], 200);
    }
}
