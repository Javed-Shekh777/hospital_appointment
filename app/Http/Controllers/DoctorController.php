<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class DoctorController extends Controller
{
    public function edit(Request $request, $id)
    {
        try {
            $doctor = Doctor::with('user')->findOrFail($id);
            return view('admin.editdoctor', compact('doctor'));
        } catch (Exception $e) {
            Log::error('Error fetching doctor details for edit: ' . $e->getMessage());
            return back()->with('error', 'Doctor details could not be retrieved.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $user = User::findOrFail($doctor->user_id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'speciality' => 'required|string',
                'fees' => 'required|numeric',
            ]);

            if ($request->hasFile('profile_image')) {
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    Storage::disk('public')->delete($user->profile_image);
                }

                $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
                $user->profile_image = $profileImagePath;
            }

            $user->fullname = $request->name;
            $user->email = $request->email;

            if ($request->password) {
                $user->password = $request->password; // Secure password
            }

            $user->save();

            $doctor->speciality = $request->speciality;
            $doctor->fees = $request->fees;
            $doctor->save();

            return redirect()->route('admin.doctors')->with('success', 'Doctor Updated Successfully!');
        } catch (Exception $e) {
            Log::error('Error updating doctor: ' . $e->getMessage());
            return back()->with('error', 'Doctor update failed! Please try again.');
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $user = User::findOrFail($doctor->user_id);

            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $doctor->delete();
            $user->delete();

            return redirect()->route('admin.doctors')->with('success', 'Doctor Deleted Successfully!');
        } catch (Exception $e) {
            Log::error('Error deleting doctor: ' . $e->getMessage());
            return back()->with('error', 'Doctor deletion failed! Please try again.');
        }
    }
}
