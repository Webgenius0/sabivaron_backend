<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
{
    try {
        // Authenticate the user
        $request->authenticate();

        // Generate a JWT token for the authenticated user
        $token = JWTAuth::fromUser(auth()->user());

        // Return the JWT token in the response
       return ApiResponse::format(true,200, 'Login successful', ['token' => $token]);
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        // Catch any JWT-related exceptions
        return response()->json([
            'status' => 'error',
            'message' => 'Could not create token, please try again.',
            'error' => $e->getMessage(),
        ], 500);
    } catch (\Exception $e) {
        // Catch any other general exceptions
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred, please try again.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
