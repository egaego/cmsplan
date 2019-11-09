<?php

namespace App\Http\Controllers\Api;

use App\Concept;
use App\Helpers\FormatConverter;
use App\Http\Controllers\Controller;
use App\Message;
use App\Page;
use App\Bank;
use App\Procedure;
use App\Transaction;
use App\ReportProblem;
use Illuminate\Http\Request;
use JWTAuth;

class RequestController extends Controller
{
    /**
     * @param Request $request
     * @return type
     */
    public function listMessages(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $models = Message::actived()->whereNull('user_relation_id')->orderBy('message_at', 'desc')->get();
        $modelHasUsers = Message::actived()->where('user_relation_id', $user->userRelation->id)->orderBy('message_at', 'desc')->get();
        
        $results = array_merge($modelHasUsers->toArray(), $models->toArray());
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $results
        ], 200);
    }

    /**
     * @param Request $request
     * @return type
     */
    public function listBank(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $models = Bank::actived()->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $models
        ], 200);
    }
    
    /**
     * @param Request $request
     * @return type
     */
    public function procedure(Request $request)
    {
        $model = Procedure::actived()->ordered()->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $model,
        ], 200);
    }
    
    /**
     * @param Request $request
     * @return type
     */
    public function getPage($category)
    {
        $model = Page::whereCategory($category)->first();
        if (!$model) {
            $model = [];
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $model
        ], 200);
    }
    
    public function storeReportProblem(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $validator = \Validator::make($request->all(), [
            'category' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
		}
        
        $reportProblem = new ReportProblem();
        $reportProblem->user_id = $user->id;
        $reportProblem->category = $request->category;
        $reportProblem->description = $request->description;
        $reportProblem->status = ReportProblem::STATUS_ACTIVE;
        $reportProblem->save();
        
        return response()->json([
            'status' => 201,
            'message' => 'Terima kasih telah meluangkan waktu Anda untuk melaporkan masalah pada Aplikasi ini.',
            'data' => []
        ], 201);
    }

    public function setupTransaction(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
		}
        
        $validator = \Validator::make($request->all(), [
            'transaction_id' => 'required',
            'bank_id' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
        }
        
        $model = Transaction::where('id', $request->transaction_id)->first();
        if (!$model) {
            return response()->json([
				'status' => 404,
				'message' => 'Transaksi tidak ada'
			], 404);
        }
        $model->bank_id = $request->bank_id;
        $model->status = Transaction::STATUS_PENDING;
        $model->save();
        
        return response()->json([
            'status' => 201,
            'message' => 'Terimakasih Anda telah order di Plan Your Days, selanjutnya silahkan cek email Anda',
        ], 201);
    }

    public function transactionHistory(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
		if ($user->token != JWTAuth::getToken()) {
			return response()->json([
				'status' => 401,
				'message' => 'Invalid credentials'
			], 401);
        }
        
        $models = Transaction::with(['transactionDetails.vendor', 'transactionDetails.concept', 'transactionDetails.vendorPackage', 'transactionDetails.vendorVoucher'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $models
        ], 200);
    }
}
