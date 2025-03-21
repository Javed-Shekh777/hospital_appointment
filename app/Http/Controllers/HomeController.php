<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function alldoctors()
    {
        return view('alldoctors');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function myProfile()
    {
        try {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->role === 'patient') {
                    return view('profile');
                }
            }
            return view('home');
        } catch (Exception $e) {
            Log::error('Error loading myProfile page: ' . $e->getMessage());
            return back()->with('error', 'Failed to load profile page.');
        }
    }

    public function myProfileUpdate(Request $request)
    {
        try {
            if (!Auth::check()) {
                return redirect('/login');
            }

            $user = User::where('email', Auth::user()->email)->firstOrFail();

            if ($request->hasFile('profile_image')) {
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    Storage::disk('public')->delete($user->profile_image);
                }

                $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
                $user->profile_image = $profileImagePath;
            }

            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->dob = $request->dob;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->gender = $request->gender ?? 'other'; // Default gender if not provided

            $user->save();

            return redirect('/my-profile')->with('success', 'Profile updated successfully!');
        } catch (Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return back()->with('error', 'Profile update failed. Please try again.');
        }
    }

    public function myappointments()
    {
        try {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->role === 'patient') {
                    return view('myappointments');
                }
            }
            return view('home');
        } catch (Exception $e) {
            Log::error('Error loading myappointments page: ' . $e->getMessage());
            return back()->with('error', 'Failed to load appointments page.');
        }
    }

    // Placeholder methods for potential future features
    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
