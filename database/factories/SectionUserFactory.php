<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class SectionUserFactory extends Factory
{
    protected $model = null;

    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement($this->getUsers()),
            'section_id' => $this->faker->randomElement($this->getSections()),
        ];
    }

    private function getUsers()
    {
        return User::pluck('id')->toArray();
    }

    private function getSections()
    {
        return Section::pluck('id')->toArray();
    }

    public function configure()
    {
        $users = $this->getUsers();
        $sections = $this->getSections();

        $combinations = [];

        foreach ($users as $user) {
            $userSections = $this->faker->randomElements($sections, 8);
            foreach ($userSections as $section) {
                $combinations[] = ['user_id' => $user, 'section_id' => $section];
            }
        }
        return $this->afterCreating(function ($pivot) use ($combinations) {
            foreach ($combinations as $combination) {
                $existingCombination = DB::table('section_user')
                    ->where('user_id', $combination['user_id'])
                    ->where('section_id', $combination['section_id'])
                    ->exists();

                if (!$existingCombination) {
                    DB::table('section_user')->insert($combination);
                }
            }
        });
    }
}
