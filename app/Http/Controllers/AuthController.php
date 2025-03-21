<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    public function registerShow()
    {
        try {
            return view("auth.register");
        } catch (Exception $e) {
            Log::error('Error loading register page: ' . $e->getMessage());
            return back()->with('error', 'Unable to load register page.');
        }
    }

    public function loginShow()
    {
        try {
            if (Auth::check()) {
                $user = Auth::user();

                // Role-based redirection
                if ($user->role === 'patient') {
                    return redirect('/');
                }

                if (in_array($user->role, ['admin', 'doctor'])) {
                    return redirect('/dashboard');
                }
            }

            return view("auth.login");
        } catch (Exception $e) {
            Log::error('Error loading login page: ' . $e->getMessage());
            return back()->with('error', 'Unable to load login page.');
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'role' => 'required|in:admin,doctor,patient',
            ]);

            $user = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => $request->password, // Secure password
                'role' => $request->role,
            ]);

            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        } catch (Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage());
            return back()->with('error', 'Registration failed! Please try again.');
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required'
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();

                if ($user->role === 'patient') {
                    return redirect('/');
                } elseif (in_array($user->role, ['admin', 'doctor'])) {
                    return redirect()->route('admin.dashboard');
                }

                return redirect('/');
            }

            return back()->withErrors(['email' => 'Invalid email or password.']);
        } catch (Exception $e) {
            Log::error('Error during login: ' . $e->getMessage());
            return back()->with('error', 'Login failed! Please try again.');
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout(); // Logout user

            $request->session()->invalidate(); // Destroy session
            $request->session()->regenerateToken(); // Regenerate CSRF token

            return redirect('/login')->with('success', 'Logged out successfully!');
        } catch (Exception $e) {
            Log::error('Error during logout: ' . $e->getMessage());
            return back()->with('error', 'Logout failed! Please try again.');
        }
    }
}
