<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

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

        foreach ($sections as $section) {
            $usersInSection = array_slice($users, 0, 8);
            foreach ($usersInSection as $user) {
                $combinations[] = ['user_id' => $user, 'section_id' => $section];
            }
            $users = array_slice($users, 8);
        }

        return $this->afterCreating(function ($pivot) use ($combinations) {
            foreach ($combinations as $combination) {
                if ($combination['user_id'] !== $pivot->user_id && $combination['section_id'] !== $pivot->section_id) {
                    $pivot->user_id = $combination['user_id'];
                    $pivot->section_id = $combination['section_id'];
                    $pivot->save();
                }
            }
        });
    }
}
