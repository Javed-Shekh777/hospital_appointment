<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        return [
            'user_id' => User::factory(), // Auto User create karega
            'speciality' => $this->faker->randomElement(['General physician','Gynecologist', 'Dermatologist', 'Neurologist', 'Gastriontrologist', 'Pediatricians']),
            'education' => $this->faker->sentence(3), // Example: "MBBS, MD"
            'experience' => $this->faker->numberBetween(1, 30), // 1 se 30 saal ka experience
            'available' => $this->faker->randomElement(['available', 'unavailable']),
            'fees' => $this->faker->randomFloat(2, 500, 100000), // ₹500 se ₹5000 tak
            'about' => $this->faker->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
