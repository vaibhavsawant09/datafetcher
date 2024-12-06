<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class CashfreePaymentController extends Controller
{
    // Show pricing plans (use your existing logic to display plans)
    public function showPricing()
    {
        $plans = SubscriptionPlan::all(); // Retrieve all subscription plans from the database
        return view('pricing', compact('plans')); // Pass plans to the view
    }

    // Initiate Payment
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


    // Payment Callback (Cashfree will redirect here after payment attempt)
    public function paymentCallback(Request $request)
    {
        $status = $request->input('txStatus'); // Transaction status
        $orderId = $request->input('orderId'); // Order ID
        $paymentReference = $request->input('referenceId'); // Payment reference (optional)

        if ($status === 'SUCCESS') {
            // Update the user's subscription status
            $user = Auth::user();
            $user->subscription_status = 1; // Mark subscription as active
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Payment successful! Your subscription is now active.');
        }

        return redirect()->route('pricing')->with('error', 'Payment failed. Please try again.');
    }
    public function handle($request, Closure $next)
    {
        if (Auth::user()->subscription_status !== 1) {
            return redirect()->route('pricing')->with('error', 'You must subscribe to access the dashboard.');
        }

        return $next($request);
    }
}
