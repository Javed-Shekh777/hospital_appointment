<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Display a listing of the resorce.
     */

   
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

    public function myProfile(){
        if (Auth::check()) {
            $user = Auth::user();
            // Role-based redirection
            if ($user->role === 'patient') {
                return view('profile');

            }
        }
        return view('home');
    }

    public function myProfileUpdate(Request $request){
        if(!Auth::check()){
             return redirect('/login');
        }

    //  dd($request->all());


     $user= User::where('email',Auth::user()->email)->first();


     if($request->hasFile('profile_image')){
        if($user->profile_image && Storage::disk('public')->exists(Auth::user()->profile_image)){
            Storage::disk('public')->delete($user->profile_image);
        }

        $profileImagePath = $request->file('profile_image')->store('profile_images','public');
        $user->profile_image = $profileImagePath;
     }


     $user->fullname = $request->fullname;
     $user->email = $request->email;
     $user->dob = $request->dob;
     $user->address = $request->address;
     $user->phone = $request->phone;
     $user->gender = $request->gender;

     $user->save();

     return redirect('/my-profile')->with('success', 'Profile updated successfully!');

    }

    public function myappointments(){
        if (Auth::check()) {
            $user = Auth::user();
            // Role-based redirection
            if ($user->role === 'patient') {
                return view('myappointments');

            }
        }
        return view('home');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(s $s)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(s $s)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, s $s)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(s $s)
    {
        //
    }
}
