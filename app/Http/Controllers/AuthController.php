<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function registerShow(){
        return view("auth.register");
    }

    public function loginShow(){
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
    }

    public function register(Request $request){
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'fullname'=>$request->fullname,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>$request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');

    }

    public function login(Request $request)
    {
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
    
            return redirect('/'); // Default case
        }
    
        return back()->withErrors(['email' => 'Invalid email or password.']);
    }
    

    public function logout(Request $request)
    {
        Auth::logout(); // User ko logout karo

        $request->session()->invalidate(); // Session destroy karo
        $request->session()->regenerateToken(); // CSRF token regenerate karo

        return redirect('/login')->with('success', 'Logged out successfully!');
    }
    
}
