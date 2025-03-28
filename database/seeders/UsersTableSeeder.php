<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Doctor;




class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        // DB::table('users')->insert([
        //     [
        //         'fullname' => 'Admin User',
        //         'email' => 'admin@example.com',
        //         'password' => '123456',
        //         'phone' => '9999999999',
        //         'role' => 'patient',
        //         'gender' => 'Male',
        //         'dob' => '1990-01-01',
        //         'address' => 'Admin Address',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'fullname' => 'Doctor User',
        //         'email' => 'doctor@example.com',
        //         'password' => '123456',
        //         'phone' => '8888888888',
        //         'role' => 'patient',
        //         'gender' => 'Female',
        //         'dob' => '1985-05-15',
        //         'address' => 'Doctor Address',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'fullname' => 'Patient User',
        //         'email' => 'patient@example.com',
        //         'password' => '123456',
        //         'phone' => '7777777777',
        //         'role' => 'patient',
        //         'gender' => 'Other',
        //         'dob' => '1995-10-20',
        //         'address' => 'Patient Address',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // ]);

    // $this->call(UsersTableSeeder::class);


    $doctors = User::factory()->count(15)->create([
        'role' => 'doctor'
    ]);

    // Seed Patients
    User::factory()->count(5)->create([
        'role' => 'patient'
    ]);

    // Ensure Doctor Factory is Called
    $doctors->each(function ($doctorUser) {
        Doctor::factory()->create(['user_id' => $doctorUser->id]);
    });

    }

}
