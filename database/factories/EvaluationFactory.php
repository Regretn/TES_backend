<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = UserFactory::new()->create();
        $q1 =  fake()->randomElement([1, 2, 3, 4, 5]);
        $q2 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q3 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q4 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q5 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q6 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q7 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q8 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q9 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q10 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q11 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q12 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q13 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q14 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q15 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q16 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q17 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q18 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q19 = fake()->randomElement([1, 2, 3, 4, 5]);
        $q20 = fake()->randomElement([1, 2, 3, 4, 5]);
        $total = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9 + $q10 + $q11 + $q12 + $q13 + $q14 + $q15 + $q16 + $q17 + $q18 + $q19 + $q20;


        return [
            'q1' => $q1,
            'q2' => $q2,
            'q3' => $q3,
            'q4' => $q4,
            'q5' => $q5,
            'q6' => $q6,
            'q7' => $q7,
            'q8' => $q8,
            'q9' => $q9,
            'q10' => $q10,
            'q11' => $q11,
            'q12' => $q12,
            'q13' => $q13,
            'q14' => $q14,
            'q15' => $q15,
            'q16' => $q16,
            'q17' => $q17,
            'q18' => $q18,
            'q19' => $q19,
            'q20' => $q20,
            'comment' => fake()->sentence(),
            'total_score' => $total,
            'teacher_id' => DB::table('users')->inRandomOrder()->value('id'),
            'user_id' => fake()->randomElement(range(1, 25)),
            'user_type' => intval(fake()->randomElement(range(1, 3))),
        ];
    }
}
