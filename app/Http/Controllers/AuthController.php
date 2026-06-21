<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form or return JSON capability.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'user' => Auth::user(),
                ]);
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials do not match our records.',
            ], 401);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect('/login');
    }

    /**
     * Handle secret admin registration.
     * Route: /register-admin-secret?secret=key
     */
    public function registerAdminSecret(Request $request)
    {
        $secret = env('ADMIN_REGISTRATION_SECRET', 'inspagenda-secret-key-123');

        if ($request->query('secret') !== $secret) {
            abort(403, 'Unauthorized secret registration attempt.');
        }

        if ($request->isMethod('get')) {
            // Render basic blade view if it exists, otherwise standard responsive form
            if (view()->exists('auth.register-secret')) {
                return view('auth.register-secret', ['secret' => $secret]);
            }
            return response('Please submit a POST request to this endpoint with name, email, password, and password_confirmation to register.', 200);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Admin user registered successfully!',
                'user' => $user,
            ], 201);
        }

        return redirect('/login')->with('success', 'Admin user registered successfully!');
    }
}
