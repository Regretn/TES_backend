<?php

namespace Database\Seeders;

use App\Models\SectionUser;
use Illuminate\Database\Seeder;

class SectionUserSeeder extends Seeder
{
    public function run()
    {
        $extendedSection = [];

        $teacherCount = 1;
        for ($i = 1; $i <= 8; $i++) {
            $assignedTeachers = [];
            for ($j = 1; $j <= 8; $j++) {
                $user_id = $teacherCount;
                $section_id = $i;
                $record = ["user_id" => $user_id, "section_id" => $section_id];

                SectionUser::firstOrCreate($record);

                $assignedTeachers[] = $teacherCount;
                $teacherCount++;
                if ($teacherCount > 17) {
                    $teacherCount = 1;
                }
            }

            // Assign remaining teachers in a round-robin fashion if the section has less than 8 teachers
            $remainingTeachers = array_diff(range(1, 17), $assignedTeachers);
            $remainingCount = 8 - count($assignedTeachers);
            for ($k = 0; $k < $remainingCount; $k++) {
                $user_id = $remainingTeachers[$k];
                $section_id = $i;
                $record = ["user_id" => $user_id, "section_id" => $section_id];

                SectionUser::firstOrCreate($record);
            }
        }
    }
}
