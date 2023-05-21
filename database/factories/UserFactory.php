<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Provider\Image;

class UserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new Image($this->faker));

        return [
            'teacher_id' => $this->faker->unique()->numerify('########'),
            'user_name' => $this->faker->name(),
            'password' => Hash::make('1234'),
            'email' => $this->faker->unique()->safeEmail(),
            'image' => $this->faker->image('public/images', 400, 300, null, false),
            'role_id' => $this->faker->randomElement([1, 2]),
        ];
    }
}
