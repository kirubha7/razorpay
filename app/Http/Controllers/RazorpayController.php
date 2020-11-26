<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Razorpay\Api\Api;
use Session;
use Redirect,Response;
use App\Payment;
class RazorpayController extends Controller
{
    public function show_products()
	{
		return view('payWithRazorpay');
	}

	public function pay_success(Request $Request){
		$data = [
		'user_id' => '1',
		'payment_id' => $request->payment_id,
		'amount' => $request->amount,
		];
		$getId = Payment::insertGetId($data);  
		$arr = array('msg' => 'Payment successful.', 'status' => true);
		return Response()->json($arr);    
	}

	public function thank_you()
	{
		return view('thankyou');
	}
}
