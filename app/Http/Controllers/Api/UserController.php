<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FormatConverter;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\User;
use File;
use Illuminate\Http\Request;
use JWTAuth;

class UserController extends Controller
{
	/**
	 * @param Request $request
	 * @return type
	 */
    public function show($code)
	{
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $user = User::whereId($code)->roleMobileApp()->first();
        
        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation->toArray();
            $relation['partner'] = $relation['female_user'];
            unset($user->maleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        } else {
            $relation = $user->femaleUserRelation->toArray();
            $relation['partner'] = $relation['male_user'];
            unset($user->femaleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
	}
    
    /**
     * update profile
     * 
     * @param type $code
     * @param Request $request
     * @return json
     */
    public function update($code, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => [
                'required',
                \Illuminate\Validation\Rule::unique('user')->ignore($user->id)
            ],
            'gender' => 'nullable|in:'.User::GENDER_MALE.','.User::GENDER_FEMALE,
            'phone' => 'nullable',
            'wedding_day' => 'required',
            'venue' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}

        $user->fill($request->only([
            'name',
            'email',
            //'gender',
            'phone',
        ]));
        $user->gender_label = $request->gender;
        $user->save();
        $user->userRelation->fill($request->only([
            'wedding_day',
            'venue'
        ]));
        $user->userRelation->save();
        
        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation->toArray();
            $relation['partner'] = $relation['female_user'];
            unset($user->maleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        } else {
            $relation = $user->femaleUserRelation->toArray();
            $relation['partner'] = $relation['male_user'];
            unset($user->femaleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Update Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
    
    /**
     * update profile
     * 
     * @param type $code
     * @param Request $request
     * @return json
     */
    public function updateRelation($code, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => [
                'required',
                \Illuminate\Validation\Rule::unique('user')->ignore($user->id)
            ],
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}

        if ($user->gender == User::GENDER_MALE) {
            $relate = User::where('id', $user->userRelation->female_user_id)->first();
            $relate->name = $request->name;
            $relate->email = $request->email;
            $relate->save();
            
            $user = User::where('id', $user->id)->first();
            
            $relation = $user->maleUserRelation->toArray();
            $relation['partner'] = $relation['female_user'];
            unset($user->maleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        } else {
            $relate = User::where('id', $user->userRelation->ale_user_id)->first();
            $relate->name = $request->name;
            $relate->email = $request->email;
            $relate->save();
            
            $user = User::where('id', $user->id)->first();
            
            $relation = $user->femaleUserRelation->toArray();
            $relation['partner'] = $relation['male_user'];
            unset($user->femaleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Update Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
    
    /**
     * @param type $code
     * @param Request $request
     * @return type
     */
    public function deletePhoto($code, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}

        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation;
            $relation->deletePhoto();
            $relation->photo = null;
            $relation->save();
            
            $relation = $user->maleUserRelation->toArray();
            $relation['partner'] = $relation['female_user'];
            unset($user->maleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        } else {
            $relation = $user->femaleUserRelation;
            $relation->deletePhoto();
            $relation->photo = null;
            $relation->save();
            
            $relation = $user->femaleUserRelation->toArray();
            $relation['partner'] = $relation['male_user'];
            unset($user->femaleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Delete Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
    
    /**
     * @param type $code
     * @param Request $request
     * @return type
     */
    public function updatePhoto($code, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}

        $validator = \Validator::make($request->all(), [
            'photo_base64' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}

        $imageBase64 = $request->photo_base64;
        if (!ImageHelper::isImageBase64($imageBase64)) {
            return response()->json([
                'status' => 400,
                'message' => 'Some Parameters is invalid',
                'validators' => [
                    'photo_base64' => 'format is invalid',
                ],
            ], 400);
        }

        $data = ImageHelper::getImageBase64Information($imageBase64);
        $img = \Eventviva\ImageResize::createFromString(base64_decode($data['data']));
        $img->resizeToWidth(780);
        $img->crop(780, 560);
        
        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation;
            $relation->deletePhoto();
            $imageFilename = $relation->generateFilename($data['extension']);
            $img->save($relation->getPath() . $imageFilename);
            $relation->photo = $imageFilename;
            $relation->save();
        } else {
            $relation = $user->femaleUserRelation;
            $relation->deletePhoto();
            $imageFilename = $relation->generateFilename($data['extension']);
            $img->save($relation->getPath() . $imageFilename);
            $relation->photo = $imageFilename;
            $relation->save();
        }

        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation->toArray();
            $relation['partner'] = $relation['female_user'];
            unset($user->maleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        } else {
            $relation = $user->femaleUserRelation->toArray();
            $relation['partner'] = $relation['male_user'];
            unset($user->femaleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Update Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
    
    public function resendRegisterRelation($userId, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $userId) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation;
            $relationPartner = $relation->femaleUser;
        } else {
            $relation = $user->femaleUserRelation;
            $relationPartner = $relation->maleUser;
        }
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:user,email,'.$relationPartner->id,
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $relationPartner->name = $request->name;
        $relationPartner->email = $request->email;
        $relationPartner->save();
        $relationPartner->sendNeedRegisterNotification();
        
        return response()->json([
            'status' => 200,
            'message' => 'Pendaftaran Sukses, Silahkan cek email yang telah didaftarkan',
            'data' => [],
        ], 200);
       
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function changePassword(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
        
        $validator = \Validator::make($request->all(), [
            'current_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
        }
        
        if (!\Hash::check($request->current_password, $user->password)) {
            return response()->json([
				'status' => 400,
				'message' => 'Current Password doesnt match',
				'validators' => null,
			], 400);
        }
        
        $user->password = bcrypt($request->password);
        $user->forgot_token = null;
        $user->save();
        
        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation->toArray();
            $relation['partner'] = $relation['female_user'];
            unset($user->maleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        } else {
            $relation = $user->femaleUserRelation->toArray();
            $relation['partner'] = $relation['male_user'];
            unset($user->femaleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Change Password Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }

    /**
     * @param type $code
     * @param Request $request
     * @return type
     */
    public function deletePhotoProfile($code, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}

        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation;
            
            $relation = $user->maleUserRelation->toArray();
            $relation['partner'] = $relation['female_user'];
            unset($user->maleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        } else {
            $relation = $user->femaleUserRelation;
            
            $relation = $user->femaleUserRelation->toArray();
            $relation['partner'] = $relation['male_user'];
            unset($user->femaleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Delete Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
    
    /**
     * @param type $code
     * @param Request $request
     * @return type
     */
    public function updatePhotoProfile($code, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $code) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }
		
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}

        $validator = \Validator::make($request->all(), [
            'photo_base64' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}

        $imageBase64 = $request->photo_base64;
        if (!ImageHelper::isImageBase64($imageBase64)) {
            return response()->json([
                'status' => 400,
                'message' => 'Some Parameters is invalid',
                'validators' => [
                    'photo_base64' => 'format is invalid',
                ],
            ], 400);
        }

        $data = ImageHelper::getImageBase64Information($imageBase64);
        $img = \Eventviva\ImageResize::createFromString(base64_decode($data['data']));
        $img->resizeToWidth(480);

        $user->deletePhoto();
        $imageFilename = $user->generateFilename("photo", $data['extension']);
        $img->save($user->getPath() . $imageFilename);
        $user->photo = $imageFilename;
        $user->save();
        
        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation;
        } else {
            $relation = $user->femaleUserRelation;
        }

        if ($user->gender == User::GENDER_MALE) {
            $relation = $user->maleUserRelation->toArray();
            $relation['partner'] = $relation['female_user'];
            unset($user->maleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        } else {
            $relation = $user->femaleUserRelation->toArray();
            $relation['partner'] = $relation['male_user'];
            unset($user->femaleUserRelation);
            unset($relation['male_user']);
            unset($relation['female_user']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Update Success',
            'data' => array_merge($user->toArray(), [
                'relation' => $relation
            ]),
        ], 200);
    }
}
