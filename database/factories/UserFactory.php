<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id' => fake()->unique()->numerify('########'),
            'user_name' => fake()->name(),
            'password' => Hash::make('1234'),
            'email' => fake()->unique()->safeEmail(),
            'image' => null,
            'role_id' => fake()->randomElement([1, 2]),
        ];
    }
}
