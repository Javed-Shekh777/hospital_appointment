<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('123456'),
            'phone' => $this->faker->phoneNumber(),
            'role' => $this->faker->randomElement(['doctor','patient']),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'dob' => $this->faker->date(),
            'address' => $this->faker->address(),
            'profile_image' => $this->faker->randomElement([
                'assets/img/gen-p-1.svg',
                'assets/img/gen-p-2.svg',
                'assets/img/gen-p-3.svg',
                'assets/img/gen-p-4.svg',
                'assets/img/gen-p-5.svg',
                'assets/img/gen-p-6.svg',
                'assets/img/gen-p-7.svg',
                'assets/img/gen-p-8.svg',
                'assets/img/gen-p-9.svg',
                'assets/img/gen-p-10.svg',
                'assets/img/gen-p-11.svg',
                'assets/img/gen-p-12.svg',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
