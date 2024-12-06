<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class SubscriptionController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has an active subscription
        if ($user->subscription_status == 1) {
            // User is subscribed, allow them to access the dashboard
            return view('dashboard');
        } else {
            // User is not subscribed, redirect to pricing page
            return redirect()->route('pricing');
        }
    }
    public function showPricing()
    {
        $plans = SubscriptionPlan::all(); // Retrieve all subscription plans from the database
        return view('pricing', compact('plans')); // Pass plans to the view
    }
    public function initiatePayment(Request $request)
    {
        $plan = SubscriptionPlan::findOrFail($request->plan_id); // Get the selected plan
        $user = Auth::user(); // Get the logged-in user

        // Prepare payment request data
        $orderId = uniqid('CF_'); // Unique order ID
        $orderAmount = $plan->price; // Plan price
        $orderCurrency = 'INR'; // Currency
        $orderNote = "Subscription Payment for Plan: {$plan->name}";

        // Prepare payment data
        $paymentData = [
            'order_id' => $orderId,
            'order_amount' => $orderAmount,
            'order_currency' => $orderCurrency,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone_number, // Ensure phone_number exists in the user table
            'redirect_url' => route('cashfree.payment.callback'),
            'order_note' => $orderNote,
        ];

        // Make a request to Cashfree API
        $response = Http::withBasicAuth(env('CASHFREE_APP_ID'), env('CASHFREE_SECRET_KEY'))
            ->post(env('CASHFREE_API_URL') . '/orders', $paymentData);

        $responseBody = $response->json();

        if ($response->successful() && isset($responseBody['payment_link'])) {
            // Redirect to the payment page
            return Redirect::to($responseBody['payment_link']);
        }

        return redirect()->route('pricing')->with('error', 'Failed to initiate payment. Please try again.');
    }
    public function paymentCallback(Request $request)
    {
        $status = $request->input('txStatus'); // Example: Check the transaction status

        if ($status === 'SUCCESS') {
            // Payment succeeded, handle success
            return redirect()->route('success.page')->with('success', 'Payment successful!');
        } else {
            // Payment failed, handle failure
            return redirect()->route('pricing')->with('error', 'Payment failed. Please try again.');
        }
    }
}
