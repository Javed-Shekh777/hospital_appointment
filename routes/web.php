<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\DoctorController;


// Simple Routes 
Route::get('/',[HomeController::class,'index'])->name('/');
Route::get('/alldoctors',[HomeController::class,'alldoctors'])->name("alldoctors");
Route::get('/about',[HomeController::class,'about'])->name("about");
Route::get('/contact',[HomeController::class,'contact'])->name("contact");
Route::get('/my-profile',[HomeController::class,'myProfile'])->name("my-profile");
Route::get('/my-appointments',[HomeController::class,'myappointments'])->name("my-appointments");

Route::post('/my-profile',[HomeController::class,'myProfileUpdate'])->name("my-profile.update");




// Authentication
Route::get('/login',[AuthController::class,'loginShow'])->name("login");
Route::get('/register', [AuthController::class, 'registerShow'])->name("register");


// Form Submission Routes 
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

 

// Admin System Routes 


Route::middleware(['role'])->prefix('dashboard')->group(function () {
    Route::get('/', 
        [AdminController::class,'dashboard']
)->name('admin.dashboard');

    Route::get('/all-appointments', 
     [AdminController::class,'allappointments'])->name('admin.allappointments');

   
    Route::get('/doctors',
     [AdminController::class, 'alldoctors']
     )->name('admin.doctors');

    Route::get('/add-doctor', function () {
        return view('admin.adddoctor');
    })->name('admin.adddoctor');
});


Route::post('/add-doctor',[AdminController::class,'addDoctor'])->name('add.doctor');
Route::get('/dashboard/doctors/edit/{id}', [DoctorController::class, 'edit'])->name('admin.doctor.edit');
Route::post('/dashboard/doctors/update/{id}', [DoctorController::class, 'update'])->name('admin.doctor.update');
Route::post('/dashboard/doctors/delete/{id}', [DoctorController::class, 'delete'])->name('admin.doctor.delete');




