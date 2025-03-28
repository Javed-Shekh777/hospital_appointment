<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
use App\Models\AvailableSlot;

class AvailableSlotFactory extends Factory
{
    protected $model = AvailableSlot::class;

    public function definition(): array
    {
        return [
            'doctor_id' => Doctor::factory(),
            'date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s'),
            'status' => $this->faker->randomElement(['available', 'booked']),
        ];
    }
}
