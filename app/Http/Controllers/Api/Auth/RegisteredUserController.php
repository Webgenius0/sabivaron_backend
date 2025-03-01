<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller {
    /**
     * Display the registration view.
     */
    public function create(): View {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {

        try {
            $request->validate([

        // dd($request);
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'  => ['required', 'confirmed'],
            'role'      => ['required', 'string', 'max:255'] ,
            'phone'     =>['required', 'string', 'max:255'],

        ]);
          // forward a random otp in phone number
          $otp = mt_rand(100000, 999999);


        } catch (\Exception $e) {
            return ApiResponse::format(false, 500, 'Failed to register user', null, $e->getMessage());
        }
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'otp' => $otp,
            'otp_created_at' => now(),
        ]);


        event(new Registered($user));

        return ApiResponse::format(true, 200, 'OTP sent successfully', $otp);
    }

    //verify that otp is correct

    public function verifyOtp(Request $request) {
        try {
            $request->validate([
                'otp' => ['required', 'numeric'],
            ]);
            

            $user = User::where('otp', $request->otp)->first();

            if ($user) {
                // Check OTP expiration (10 minutes for example)
                if ($user->otp_created_at->diffInMinutes(now()) > 10) {
                    return ApiResponse::format(false, 500, 'OTP expired', null, 'Please request a new OTP.');
                }

                // Clear the OTP and log the user in
                $user->otp = null;
                $user->save();
                Auth::login($user);

                return ApiResponse::format(true, 200, 'OTP verified successfully', null);
            } else {
                return ApiResponse::format(false, 500, 'Failed to verify OTP', null, 'Invalid OTP');
            }
        } catch (\Exception $e) {
            return ApiResponse::format(false, 500, 'Failed to verify OTP', null, $e->getMessage());
        }
    }
}
