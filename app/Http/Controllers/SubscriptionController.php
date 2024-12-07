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
}
