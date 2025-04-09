<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function initiatePayment()
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        dd($api);

        $orderData = [
            'receipt' => 'order_'.rand(1000,9999),
            'amount' => 50000, // 500 INR (paise में देना होता है)
            'currency' => 'INR',
            'payment_capture' => 1 // auto capture on
        ];

        $razorpayOrder = $api->order->create($orderData);
        $orderId = $razorpayOrder['id'];

        return view('razorpay.paymentPage', compact('orderId'));
    }

    public function paymentSuccess(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $payment = $api->payment->fetch($request->razorpay_payment_id);
            if ($payment->status == 'captured') {
                return "Payment successful!";
            }
        } catch (\Exception $e) {
            return "Payment failed!";
        }
    }
}
