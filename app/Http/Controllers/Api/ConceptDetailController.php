<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\FormatConverter;
use App\ConceptDetail;
use App\Concept;
use App\User;
use App\Transaction;
use App\TransactionDetail;
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

        $transaction = Transaction::where('user_id', $user->id)->where('status', Transaction::STATUS_DRAFT)->first();
        if (!$transaction) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'admin_fee' => 0,
                'total' => 0,
                'data' => []
            ], 200);
        }
        
        $models = TransactionDetail::with(['vendor', 'concept', 'vendorPackage', 'vendorVoucher'])->where('user_id', $user->id)
            ->where('transaction_id', $transaction->id)
            ->orderBy('created_at', 'DESC')->get();

        $adminFee = $transaction->admin_fee;
        $total = $transaction->grand_total;
        
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'admin_fee' => $adminFee,
            'total' => $total,
            'data' => $models,
            'transaction_id' => $transaction->id
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
            'vendor_package_id' => 'required',
            'vendor_voucher_id' => 'nullable',
            'discount' => 'nullable',
            'price' => 'required',
            'date' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => FormatConverter::parseValidatorErrors($validator),
			], 400);
        }

        $transaction = Transaction::where('user_id', $user->id)->where('status', Transaction::STATUS_DRAFT)->first();
        if (!$transaction) {
            $transaction = new Transaction();
            $transaction->code = Transaction::generateCode();
            $transaction->user_id = $user->id;
            $transaction->payment_type_id = 1;
            $transaction->status = Transaction::STATUS_DRAFT;
            $transaction->status_payment = Transaction::STATUS_PAYMENT_PENDING;
        }
        $transaction->save();

        $discount = 0;
        if ($request->discount) {
            $discount = $request->discount;
        }

        $detail = new TransactionDetail();
        $detail->transaction_id = $transaction->id;
        $detail->user_id = $user->id;
        $detail->concept_id = $request->concept_id;
        $detail->vendor_id = $request->vendor_id;
        $detail->vendor_voucher_id = $request->vendor_voucher_id;
        $detail->vendor_package_id = $request->vendor_package_id;
        $detail->total = $request->price;
        $detail->voucher_discount = $discount;
        $detail->grand_total = ((int)$request->price -  (int)$discount);
        $detail->save();

        $details = TransactionDetail::with(['vendor', 'concept', 'vendorPackage', 'vendorVoucher'])->where('user_id', $user->id)
            ->where('transaction_id', $transaction->id)
            ->orderBy('created_at', 'DESC')->get();
        $total = 0;
        foreach ($details as $model) {
            $total += $model->grand_total;
        }
        $transaction->total = $total;
        $transaction->admin_fee = rand(100, 1000);
        $transaction->grand_total = $total + $transaction->admin_fee;
        $transaction->save();
        
        return response()->json([
            'status' => 201,
            'message' => 'Success',
            'data' => $details,
            'admin_fee' => $transaction->admin_fee,
            'total' => $total,
            'transaction_id' => $transaction->id
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
        
        TransactionDetail::where('id', $id)->delete();

        $transactionId = 0;
        $transaction = Transaction::where('user_id', $user->id)->where('status', Transaction::STATUS_DRAFT)->first();
        if (!$transaction) {
            return response()->json([
                'status' => 200,
                'message' => 'Remove Success',
                'total' => 0,
                'data' => []
            ], 200);
        }

        $transactionId = $transaction->id;
        
        $models = TransactionDetail::with(['vendor', 'concept', 'vendorPackage', 'vendorVoucher'])->where('user_id', $user->id)
            ->where('transaction_id', $transaction->id)
            ->orderBy('created_at', 'DESC')->get();

        $adminFee = $transaction->admin_fee;
        $total = $transaction->grand_total;

        if (count($transaction->transactionDetails->toArray()) <= 0) {
            $transaction->delete();
            $transactionId = 0;
        }
        
        return response()->json([
            'status' => 200,
            'message' => 'Remove Success',
            'admin_fee' => $adminFee,
            'total' => $total,
            'data' => $models,
            'transaction_id' => $transactionId
        ], 200);
    }
}
