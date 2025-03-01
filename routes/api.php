<?php

use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*auth

*/

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/verify', [RegisteredUserController::class, 'verifyOtp']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// Route::post('/reset', [ForgetPasswordController::class, 'requestReset']);
// Route::post('/reset-password', [ForgetPasswordController::class, 'resetPassword']);
// Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:api');




// Route::middleware(['auth:api', 'role:hairdresser'])->group(function () {
//     Route::get('/hairdressers/weekly-payment', [HairHomeController::class, 'weeklyPayment']);
//     Route::get(('/hairdressers/monthly-payment'), [HairHomeController::class, 'monthlyPayment']);
//     Route::get(('/hairdressers/yearly-payment'), [HairHomeController::class, 'yearlyPayment']);

// });
