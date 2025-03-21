<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;


class AdminController extends Controller
{

    public function addDoctor(Request $request){

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
        // dd($request->hasFile('profile_image'));
    

        $profileImagePath = null;
        if($request->hasFile('profile_image')){
            $profileImagePath = $request->file('profile_image')->store('profile_images','public');
        }

        $user = User::create([
            'fullname'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'phone'=>$request->phone,
            'role'=>'doctor',
            'gender'=>$request->gender,
            'profile_image' => $profileImagePath,
            'address' => $request->address,
        ]);

        $doctor = Doctor::create([
            'user_id' => $user->id,
            'speciality' => $request->speciality,
            'education' => $request->education,
            'experience' => $request->experience,
            'fees' => $request->fees,
            'about' => $request->about,
        ]);

        return redirect()->route('admin.doctors')->with('success', 'Doctor added successfully!');

    }


    public function dashboard(){
        $doctorCount = Doctor::count();
        $appointmentCount = Appointment::count();
        $patientCount = User::where('role','patient')->count();
        $totalEarning = Doctor::sum('fees');
        return view('admin.dashboard',compact('doctorCount','appointmentCount','patientCount','totalEarning'));

    }


    public function allappointments(){
        return view('admin.allappointments');
    }


    public function alldoctors(){
        $doctors = Doctor::with('user')->get();
        return view('admin.doctors', compact('doctors'));
    }
 






}
