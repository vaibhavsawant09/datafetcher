<?php

use App\Http\Controllers\CashfreePaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('forgot-password', function () {
    return view('forgot-password');
});
Route::get('login', function () {
    return view('login');
});
Route::get('register', function () {
    return view('register');
});

Route::middleware('auth')->get('/dashboard', [SubscriptionController::class, 'index'])->name('dashboard');
Route::get('/pricing', function () {
    $plans = DB::table('subscription_plans')->get();
    return view('pricing', ['plans' => $plans]);
})->name('pricing');


Route::post('cashfree/payments/create', [CashfreePaymentController::class, 'create'])->name('callback');
Route::post('cashfree/payments/store', [CashfreePaymentController::class, 'store'])->name('store');
Route::any('cashfree/payments/success', [CashfreePaymentController::class, 'success'])->name('success');

Route::get('/subscription/success', function () {
    return view('subscription-success'); // Create this view
})->name('subscription.success');

Route::get('/subscription/failure', function () {
    return view('subscription-failure'); // Create this view
})->name('subscription.failure');



Route::get('dashboard/bussiness', function () {
    return view('dashboard/bussiness');
})->middleware(['auth', 'verified'])->name('bussiness');
Route::get('dashboard/receipts', function () {
    return view('dashboard/receipts');
})->middleware(['auth', 'verified'])->name('receipts');
Route::get('/dashboard/invoices', function () {
    return view('dashboard/invoices');
})->middleware(['auth', 'verified'])->name('invoices');
Route::get('dashboard/bankstatement', function () {
    return view('dashboard/bankstatement');
})->middleware(['auth', 'verified'])->name('bankstatement');
Route::get('dashboard/iddocument', function () {
    return view('dashboard/iddocument');
})->middleware(['auth', 'verified'])->name('iddocument');
Route::get('dashboard/yourdata', function () {
    return view('dashboard/yourdata');
})->middleware(['auth', 'verified'])->name('yourdata');


Route::get('dashboard/billing', function () {
    // Retrieve the latest subscription for the authenticated user
    $subscription = DB::table('subscriptions')
        ->where('user_id', Auth::id())
        ->latest('created_at')
        ->first();

    // Calculate the remaining days until expiration
    $remainingDays = null;
    if ($subscription && $subscription->end_date) {
        $remainingDays = now()->diffInDays(\Carbon\Carbon::parse($subscription->end_date), false);
    }

    // Retrieve all subscriptions of the user for the history section
    $user = Auth::user();  // Get the authenticated user

    return view('dashboard.billing', [
        'subscription' => $subscription,
        'remainingDays' => $remainingDays,
        'user' => $user,  // Pass the user data to the view
    ]);
})->middleware(['auth', 'verified'])->name('billing');




Route::get('dashboard/account', function () {
    return view('dashboard/account');
})->middleware(['auth', 'verified'])->name('account');
Route::get('dashboard/notifications', function () {
    return view('dashboard/notifications');
})->middleware(['auth', 'verified'])->name('notifications');
Route::get('/dashboard', function () {
    return view('dashboard/index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
