<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class CashfreePaymentController extends Controller
{
    public function showBillingPage()
    {
        // Get the logged-in user
        $user = Auth::user();

        // Fetch the user's subscription details
        $subscription = Subscription::where('user_id', $user->id)->latest()->first();

        // Calculate remaining days for the plan (if applicable)
        $remainingDays = null;
        if ($subscription && $subscription->end_date) {
            $remainingDays = now()->diffInDays($subscription->end_date, false); // Calculate remaining days
        }

        // Pass subscription details and remaining days to the view
        return view('billing', [
            'subscription' => $subscription,
            'remainingDays' => $remainingDays,
        ]);
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'amount' => 'required|numeric',
        ]);

        // Generate a unique order ID
        $orderId = 'order_' . rand(1111111111, 9999999999); // Random order ID
        $amount = $validated['amount']; // Amount to be paid

        // Customer Details
        $customerDetails = [
            'customer_id' => 'customer_' . rand(111111111, 999999999),
            'customer_name' => $validated['name'],
            'customer_email' => $validated['email'],
            'customer_phone' => '91' . rand(1000000000, 9999999999) // Add a random phone number
        ];

        // Return URL after successful payment
        $returnUrl = route('success') . '?order_id={order_id}&order_token={order_token}';

        // Cashfree API URL and headers
        $url = "https://sandbox.cashfree.com/pg/orders";
        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . env('CASHFREE_API_KEY'),
            "x-client-secret: " . env('CASHFREE_API_SECRET')
        ];

        // Prepare request body with additional necessary fields
        $data = json_encode([
            'order_id' => $orderId,
            'order_amount' => $amount,
            'order_currency' => 'INR',
            'customer_details' => $customerDetails,
            'order_meta' => [
                'return_url' => $returnUrl,
            ],
        ]);

        // Initialize cURL session to send the request to Cashfree
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        // Execute the cURL request
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            return response()->json(['error' => curl_error($curl)], 500);
        }

        // Close the cURL session
        curl_close($curl);

        // Log the raw response from Cashfree for debugging
        \Log::info('Cashfree API Response: ', ['response' => $response]);

        // Decode the response from Cashfree
        $responseData = json_decode($response, true);

        // Log the response data for further debugging
        \Log::info('Cashfree Response Data: ', ['response_data' => $responseData]);

        // Check if payment link is provided in the response
        if (!isset($responseData['payment_link'])) {
            // Log the error message if payment link is not found
            \Log::error('Cashfree Error: Payment link not found', ['response' => $responseData]);

            return response()->json(['error' => 'Payment link not found'], 500);
        }

        // Redirect the user to the payment link provided by Cashfree
        return redirect()->to($responseData['payment_link']);
    }



    public function success(Request $request)
    {
        // Capture the Cashfree response
        $order_id = $request->input('order_id');
        $order_token = $request->input('order_token');

        // Optional: Verify the payment status via Cashfree API (Recommended for better security)
        $url = "https://sandbox.cashfree.com/pg/orders/$order_id";
        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . env('CASHFREE_API_KEY'),
            "x-client-secret: " . env('CASHFREE_API_SECRET'),
        ];

        // Initialize cURL session to verify payment status
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Skip for development only
        $response = curl_exec($curl);
        curl_close($curl);

        $paymentDetails = json_decode($response, true);

        // Log payment verification response for debugging
        \Log::info('Cashfree Payment Verification Response: ' . $response);

        // Check if payment is successful
        if ($paymentDetails && isset($paymentDetails['order_status']) && $paymentDetails['order_status'] === 'PAID') {
            // Find the user (Assuming user is logged in)
            $user = Auth::user(); // Or find user by email, ID, etc.

            if ($user) {
                // Assuming subscription model and user subscription details exist
                // Create subscription record (if necessary)
                $subscription = new Subscription();
                $subscription->user_id = $user->id;
                $subscription->amount = $paymentDetails['order_amount']; // Payment amount
                $subscription->activation_date = now(); // Current timestamp
                $subscription->end_date = now()->addMonth(); // Add 1 month to current date
                $subscription->save();

                // Redirect to success page with relevant data
                return view('subscription-success', [
                    'amount' => $paymentDetails['order_amount'],
                    'activation_date' => now(),
                    'end_date' => now()->addMonth(),
                ]);
            }

            // Handle case where user is not found
            return redirect()->route('subscription.failure')->with('error', 'User not found. Please contact support.');
        }

        // Handle payment failure or invalid response
        return redirect()->route('subscription.failure')->with('error', 'Payment failed or invalid response received. Please try again.');
    }
}
