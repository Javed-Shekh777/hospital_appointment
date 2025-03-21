<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class AdminController extends Controller
{
    public function addDoctor(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'speciality' => 'required|string',
                'experience' => 'required|integer',
                'education' => 'required|string',
                'gender' => 'required|string',
                'fees' => 'required|numeric',
                'about' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle image upload
            $profileImagePath = null;
            if ($request->hasFile('profile_image')) {
                $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            }

            // Create user
            $user = User::create([
                'fullname' => $request->name,
                'email' => $request->email,
                'password' =>  $request->password, // Encrypt password
                'phone' => $request->phone,
                'role' => 'doctor',
                'gender' => $request->gender,
                'profile_image' => $profileImagePath,
                'address' => $request->address,
            ]);

            // Create doctor profile
            Doctor::create([
                'user_id' => $user->id,
                'speciality' => $request->speciality,
                'education' => $request->education,
                'experience' => $request->experience,
                'fees' => $request->fees,
                'about' => $request->about,
            ]);

            return redirect()->route('admin.doctors')->with('success', 'Doctor added successfully!');
        } catch (Exception $e) {
            Log::error('Error adding doctor: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function dashboard()
    {
        try {
            $doctorCount = Doctor::count();
            $appointmentCount = Appointment::count();
            $patientCount = User::where('role', 'patient')->count();
            $totalEarning = Doctor::sum('fees');

            return view('admin.dashboard', compact('doctorCount', 'appointmentCount', 'patientCount', 'totalEarning'));
        } catch (Exception $e) {
            Log::error('Error loading dashboard: ' . $e->getMessage());

            return back()->with('error', 'Unable to load dashboard data.');
        }
    }

    public function allappointments()
    {
        try {
            return view('admin.allappointments');
        } catch (Exception $e) {
            Log::error('Error loading appointments: ' . $e->getMessage());

            return back()->with('error', 'Unable to load appointments.');
        }
    }

    public function alldoctors()
    {
        try {
            $doctors = Doctor::with('user')->get();
            return view('admin.doctors', compact('doctors'));
        } catch (Exception $e) {
            Log::error('Error loading doctors list: ' . $e->getMessage());

            return back()->with('error', 'Unable to load doctors.');
        }
    }
}
