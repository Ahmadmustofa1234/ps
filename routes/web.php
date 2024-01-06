<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
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
// midtrans
Route::post('/checkout',[OrderController::class, 'checkout'])->name('checkout');
Route::get('/invoice/{id}',[OrderController::class, 'invoice'])->name('invoice');

// auth
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/create',[AuthController::class, 'create'])->name('create');
    Route::post('/auth', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/ResetPass', [AuthController::class, 'ResetPass'])->name('auth.ResetPass');
    Route::get('/verify/{verify_key}', [AuthController::class, 'verify']);
});

// 
// Rute Lupa Password
Route::get('/forgot', [AuthController::class, 'forgot'])->name('auth.forgot');
Route::post('/sendResetLinkEmail', [AuthController::class, 'sendResetLinkEmail'])->name('auth.password');
Route::get('/reset/{token}', [AuthController::class, 'Reset'])->name('reset');
Route::post('/reset/{token}', [AuthController::class, 'resetPassword'])->name('reset');

//login google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
