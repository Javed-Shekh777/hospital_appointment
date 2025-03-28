<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\AvailableSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class HomeController extends Controller
{
    public function index()
    {
         
            $doctors = Doctor::with('user')->get();
     
        
        return view('home',compact('doctors'));
    }

    public function alldoctors(Request $request)
    {

        $doctors = null;
        if($request->query('specialization')){
            $specialization = $request->query('specialization');
            $doctors = Doctor::where('speciality',$specialization)->with('user')->get();
        }else{
            $doctors = Doctor::with('user')->get();
        }
        
        return view('alldoctors',compact('doctors'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function doctor(Request $request,$id)
    {
        try {
            $doctor = Doctor::with(['user','slots'=>function($query){
                $query->where('status','!=','booked')->orderBy('date','asc')->orderBy('start_time','asc');
                
            }])->findOrFail($id);
                 
                $groupedSlots = $doctor->slots->groupBy('date');
       
            $specialization = $doctor->speciality;
            $doctors = Doctor::where('user_id', '!=', $id)
                 ->where('speciality', $specialization)
                 ->with(['user']) // Multiple relations
                 ->get();

            return view('doctor', compact('doctor','doctors','groupedSlots'));
        } catch (Exception $e) {

            Log::error('Error fetching doctor details for edit: ' . $e->getMessage());
            return back()->with('error', 'Doctor details could not be retrieved.');
        }
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
                $myAllAppointments = Appointment::with(['doctor.user','slot'])->get();

                // dd($myAllAppointments[0]->slot->date);
                return view('myappointments',compact('myAllAppointments'));
            }
            return view('home');
        } catch (Exception $e) {
            dd($e);
            Log::error('Error loading myappointments page: ' . $e->getMessage());
            return back()->with('error', 'Failed to load appointments page.');
        }
    }
    public function bookappointment(Request $request)
    {
        
        try {
            // Validate the request
            $validatedData = $request->validate([
                'patient_id' => 'required|exists:users,id',  
                'doctor_id' => 'required|exists:doctors,id', 
                'date' => 'required|date',
                'time' => 'required|date_format:h:i:s',
                'slot_id' => 'required|exists:available_slots,id',
            ]);

            // $doctorId = Doctor::findOrFails($request->doctor_id)->with;

    
            // Update slot as booked
            AvailableSlot::where('id', $request->slot_id)->update([
                'status' => 'booked', 
            ]);
    
            // Create appointment
            Appointment::create([
                'patient_id' => $request->patient_id, 
                'doctor_id' => $request->doctor_id, 
                'slot_id' => $request->slot_id, 
            ]);
    
            return redirect()->route('my-appointments')->with('success', 'Appointment booked successfully');
    
        } catch (\Exception $e) {
            // 🔥 Yahan error log aur dump karo taaki problem pata chale
            Log::error('Error saving appointment: ' . $e->getMessage());
    
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
    

    public function cancelappointment(Request $request,$id)
    {
        try {
            $appointment = Appointment::with(['doctor.user','slot'])->findOrFail($id);
            AvailableSlot::where('id',$appointment->slot_id)->update([
                'status'=>'available'
            ]);
          
            $appointment->delete();
            return redirect()->back()->with('success', 'Appointment cancelled successfully.');
     
        } catch (Exception $e) {
            dd($e);
            Log::error('Error deleting appointment ' . $e->getMessage());
            return back()->with('error', 'Appointment  could not be deleted.');
        }
    }

   
}
