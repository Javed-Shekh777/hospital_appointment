<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\AvailableSlot;
use Carbon\Carbon;

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
                'slot_date' => 'required|array',
                'slot_start_time' => 'required|array',
                'slot_end_time' => 'required|array',
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
           $doctor =  Doctor::create([
                'user_id' => $user->id,
                'speciality' => $request->speciality,
                'education' => $request->education,
                'experience' => $request->experience,
                'fees' => $request->fees,
                'about' => $request->about,
            ]);

            foreach ($request->slot_date as $key => $date) {
                AvailableSlot::create([
                    'doctor_id' => $doctor->id,
                    'date' => $date,
                    'start_time' => $request->slot_start_time[$key],
                    'end_time' => $request->slot_end_time[$key],
                    'status' => 'available',
                ]);
            }

            return redirect()->route('admin.doctors')->with('success', 'Doctor added successfully!');
        } catch (Exception $e) {
            dd($e);
            Log::error('Error adding doctor: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function dashboard()
    {
        try {
            $oneWeek = Carbon::now()->subWeek();
            $doctorCount = Doctor::count();
            $latestAppointments = Appointment::with(['doctor.user','slot'])->whereBetween('created_at',[$oneWeek,Carbon::now()])->latest('created_at')->get();
            $patientCount = User::where('role', 'patient')->count();
            $totalEarning = Doctor::sum('fees');
            $appointmentCount = $latestAppointments->count();

            return view('admin.dashboard', compact('doctorCount', 'appointmentCount', 'patientCount', 'totalEarning','latestAppointments'));
        } catch (Exception $e) {
            Log::error('Error loading dashboard: ' . $e->getMessage());

            return back()->with('error', 'Unable to load dashboard data.');
        }
    }

    public function allappointments()
    {
        try {
            $user = auth()->user();
            $doctor =Doctor::where('user_id',$user->id)->first();

            if($user->role == 'admin'){
                $appointments = Appointment::with(['doctor.user','patient','slot'])->get();
            }else{

                $appointments = Appointment::where('doctor_id',$doctor->id)->with(['doctor.user','patient','slot'])->get();
            }
            // dd($appointments[0]->slot->date);
           
            return view('admin.allappointments',compact('appointments'));
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

    public function allusers(Request $request){
        try{

            $user = auth()->user();


            if($user->role == 'admin'){

               
                $users = User::with(['doctor'])->get();

                return view('admin.allusers',compact('users','user'));

            }else{
                return redirect('dashboard');

            }
        }catch (Exception $e) {
            Log::error('Error loading doctors list: ' . $e->getMessage());
            return back()->with('error', 'Unable to load doctors.');
        }
    }

    public function allpatients()
    {
        try {

            $user = auth()->user();

            if($user->role == 'admin'){
                $patients = User::where('role','patient')->with(['appointments'])->get();
                // dd($patients);
            }elseif($user->role == 'doctor'){
                User::whereHas('appointments', function ($query) use ($user) {
                    $query->with('appointments')->where('doctor_id', $user->id);
                })->get();
            }
            return view('admin.patients', compact('patients'));
        } catch (Exception $e) {
            Log::error('Error loading doctors list: ' . $e->getMessage());

            return back()->with('error', 'Unable to load doctors.');
        }
    }


    public function viewUser(Request $request,$id){
        try{

            
            $user = User::with(['doctor.slots'])->findOrFail($id);
            // dd($user->doctor->slots[0]->id);
            return view('admin.viewandupdate', compact('user'));
              
        }catch (Exception $e) {
            Log::error('Error loading User list: ' . $e->getMessage());

            return back()->with('error', 'Unable to load user.');
        }

    } 


    public function updateUser(Request $request, $id) {
        try {
            $user = User::findOrFail($id);
            $doctor = Doctor::where('user_id', $user->id)->first();
    
            $validatedData = $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'role' => 'required',
                'phone' => 'required|string',
                'address' => 'required|string',
                'gender' => 'required',
                // Doctor related data
                'slot_date' => 'nullable|array',
                'slot_start_time' => 'nullable|array',
                'slot_end_time' => 'nullable|array',
                'speciality' => 'nullable|string',
                'fees' => 'nullable|numeric',
                'about' => 'nullable|string',
            ]);
    
            if ($request->hasFile('profile_image')) {
                $oldImage = $user->profile_image;
                $imagePath = public_path('storage/' . $oldImage);
    
                if (!empty($oldImage) && file_exists($imagePath)) {
                    unlink($imagePath);
                }
    
                $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
                $user->profile_image = $profileImagePath;
            }

    
            if ($user->role != 'doctor' && $request->role == 'doctor') {
                $newdoctor = Doctor::create([
                    'user_id' => $user->id,
                    'speciality' => $request->speciality,
                    'education' => $request->education,
                    'experience' => $request->experience,
                    'fees' => $request->fees,
                    'about' => $request->about,
                ]);
    
                if ($request->has('slot_date')) {
                    foreach ($request->slot_date as $key => $date) {
                        AvailableSlot::create([
                            'doctor_id' => $newdoctor->id,
                            'date' => $date,
                            'start_time' => $request->slot_start_time[$key],
                            'end_time' => $request->slot_end_time[$key],
                            'status' => 'available',
                        ]);
                    }
                }
            }
    
            if ($user->role == 'doctor' && $request->role == 'doctor') {
                $doctor->speciality = $request->speciality;
                $doctor->about = $request->about;
                $doctor->education = $request->education;
                $doctor->experience = $request->experience;
                $doctor->fees = $request->fees;
                $doctor->save();
    
    
                if ($request->has('slot_date')  && count($request->slot_date) > 0) {
                AvailableSlot::where('doctor_id', $doctor->id)->delete();

                    foreach ($request->slot_date as $key => $date) {
                        AvailableSlot::create([
                            'doctor_id' => $doctor->id,
                            'date' => $date,
                            'start_time' => $request->slot_start_time[$key],
                            'end_time' => $request->slot_end_time[$key],
                            'status' => 'available',
                        ]);
                    }
                }
            }
    
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->dob = $request->dob;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->role = $request->role;
            $user->save();
    
            return redirect()->route('admin.allusers')->with('success', 'User Updated Successfully!');
        } catch (Exception $e) {
            Log::error('Error updating user', [
                'error' => $e->getMessage(),
                'user_id' => $id,
                'request' => $request->all(),
            ]);
            return back()->with('error', 'User update failed! Please try again.');
        }
    }
    

    


    public function deleteUser(Request $request,$id){
        try{

            $user = User::findOrFail($id);
            $doctor = Doctor::where('user_id', $user->id)->first();
            $appointments = Appointment::where(['patient_id'=> $user->id])->get();
            $payments = Payment::where(['user_id'=>$user->id])->get();
            $slots = AvailableSlot::where(['doctor_id'=>$user->id])->get();


            if($appointments){
                foreach($appointments as $item){
                    $item->delete();
                }
            }

          
            if($payments){
                foreach($payments as $item){
                    $item->delete();
                }
            }
            if($user->profile_image && Storage::disk('public')->exists($user->profile_image)){
                Storage::disk('public')->delete($user->profile_image);
            }

            if($user->role == 'doctor' && $doctor && $slots){
                $doctor->delete();
                foreach($slots as $item){
                    $item->delete();
                }
            }

            $user->delete();

            return redirect()->route('admin.allusers')->with('success', 'User Deleted Successfully!');

        }catch (Exception $e){
            dd($e);
            Log::error('Error deleting User'.$e->getMessage());
            return back()->with('error','User Deletion failed! Please try again.');
        }
    }
}
