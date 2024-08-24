<?php

namespace App\Http\Controllers;


// use Config;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RemoteMerge\Esewa\Client;
use RemoteMerge\Esewa\Config;


/*
    9806800001
    Nepal@123
    token: 123456

*/

class EsewaController extends Controller
{

    protected $esewa;
    public function esewaPay(Request $request)
    {

        // create record on db but keep it as unverified.
        // update verified or failed depending on payment verification status 


        // dd($request->all());
        $pid = uniqid();

        Order::insert([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'product_id' => $pid,
            'amount' => $request->amount,
            'esewa_status' => 'unverified',
            'created_at' => Carbon::now(),
        ]);


        $successUrl = url('/success');
        $failureUrl = url('/failure');

        // config for development
        $config = new Config($successUrl, $failureUrl);

        // config for production
        // $config = new Config($successUrl, $failureUrl, 'b4e...e8c753..2c6e8b', 'production');

        // initialize esewa Client
        $$this->esewa = new Client($config);

        // now redirect user to esewa dashboard
        // once the payment is successful, it will redirect to your success URL or failure URL


        // make payment
        $this->esewa->process($pid, $request->amount, 0, 0, 0);
    }

    // invoke when success
    public function esewaPaySuccess()
    {
        // dd('success');
        $pid = $_GET['oid'];
        // dd($pid);
        $amt = $_GET['amt'];
        $refId = $_GET['refId'];

        $status = $this->esewa->verify($refId, $pid, $amt);

        // if unverified back to failure page
        if (!$status) {
            $msg  = 'Failure';
            $msg1 = 'Payment Failed! Please Try again later';
            return view('thankyou', compact('msg', 'msg1'));
        }

        $order = Order::where('product_id', $pid)->first();
        $order->esewa_status = 'verified';
        $udpate_status = $order->update();


        $msg  = 'Success';
        $msg1 = 'Payment Success! Thank you for makinng purchase.';
        if ($udpate_status) {
            return view('thankyou', compact('msg', 'msg1'));
        }
    }

    public function esewaPayFailure()
    {
        $pid = $_GET['pid'];
        $order = Order::where('product_id', $pid)->first();
        $order->esewa_status = 'failed';
        $udpate_status = $order->update();


        $msg  = 'Failure';
        $msg1 = 'Payment Failed! Please Try again later';
        if ($udpate_status) {
            return view('thankyou', compact('msg', 'msg1'));
        }
    }
}
