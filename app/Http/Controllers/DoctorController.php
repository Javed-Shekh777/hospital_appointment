<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class DoctorController extends Controller
{
  




public function edit(Request $request,$id)
{
    $doctor = Doctor::with('user')->findOrFail($id);

    return view('admin.editdoctor', compact('doctor'));
}

public function update(Request $request,$id)
{
    $doctor = Doctor::findOrFail($id);
    $user = User::findOrFail($doctor->user_id);

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'speciality' => 'required|string',
        'fees' => 'required|numeric',
    ]);

    if($request->hasFile('profile_image')){

        if($user->profile_image && Storage::disk('public')->exists($user->profile_image)){
            Storage::disk('public')->delete($user->profile_image);
        }

        $profileImagePath = $request->file('profile_image')->store('profile_images','public');
        $user->profile_image = $profileImagePath;   
    }

    $user->fullname = $request->name;
    $user->email = $request->email;
    if($request->password){
        $user->password = $request->password; 
    }
    $user->save();
    $doctor->speciality = $request->speciality;
    $doctor->fees = $request->fees;
    $doctor->save();

    return redirect()->route('admin.doctors')->with('success', 'Doctor Updated Successfully!');
}


    public function delete(Request $request,$id){
        $doctor = Doctor::findOrFail($id);
        $user = User::findOrFail($doctor->user_id);
       
        if($user->profile_image && Storage::disk('public')->exists($user->profile_image)){
            Storage::disk('public')->delete($user->profile_image);
        }

        // $doctor->user()->delete();
        $doctor->delete();
        $user->delete();
    return redirect()->route('admin.doctors')->with('success', 'Doctor Delete Successfully!');
    }



}
