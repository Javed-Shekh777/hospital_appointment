<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\AvailableSlot;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Doctors
        $doctors = User::factory()->count(15)->create([
            'role' => 'doctor'
        ]);

        // Seed Patients
        User::factory()->count(5)->create([
            'role' => 'patient'
        ]);

        // Ensure Doctor Factory is Called & Create Available Slots
        $doctors->each(function ($doctorUser) {
            $doctor = Doctor::factory()->create(['user_id' => $doctorUser->id]);

            // Seed Available Slots for each Doctor
            AvailableSlot::factory()->count(5)->create([
                'doctor_id' => $doctor->id,
            ]);
        });
    }
}
