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

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'speciality' => $this->faker->randomElement(['General physician','Gynecologist', 'Dermatologist', 'Neurologist', 'Gastriontrologist', 'Pediatricians']),
            'education' => $this->faker->sentence(3),
            'experience' => $this->faker->numberBetween(1, 30),
            'available' => $this->faker->randomElement(['available', 'unavailable']),
            'fees' => $this->faker->randomFloat(2, 500, 100000),
            'about' => $this->faker->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
