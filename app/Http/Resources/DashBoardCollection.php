<?php

namespace App\Http\Resources;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Evaluation;
use App\Models\Section;
use Random\Engine\Secure;

class DashboardCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $grouped = $this->collection->groupBy('teacher_id');
        $students = Student::count();
        $teachers = User::count();

        //total evaluatee
        $total_evaluatee_teacher = $this->collection->where('user_type', '=', 2)->groupBy('teacher_id')->count();
        $total_evaluatee_student = $this->collection->where('user_type', '=', 3)->groupBy('section_id')->count();
        $total_evaluatee = $students + $total_evaluatee_teacher;
        $sections = [];
        $student_sections = Student::select('section_id')->distinct()->pluck('section_id');


        //Section of student per section
        foreach ($student_sections as $section_id) {
            $count = Student::where('section_id', $section_id)->count();
            $section_name = Section::where('id', $section_id)->pluck('section_name')->first();
            $section = [
                'section_id' => $section_id,
                'section_name' => $section_name,
                'count' => $count,
            ];
            $sections[] = $section;
        }

        usort($sections, function ($a, $b) {
            preg_match('/(\d+)/', $a['section_name'], $a_matches);
            preg_match('/(\d+)/', $b['section_name'], $b_matches);
            $a_int = $a_matches[1];
            $b_int = $b_matches[1];

            if ($a_int == $b_int) {
                return 0;
            }
            return ($a_int < $b_int) ? -1 : 1;
        });


        //Percentage of q1 to q20 and their criteria
        $percentages = [];
        $categories = [];
        $year = date('Y');

        if (!is_null($this->resource)) {
            $total = $this->resource->where('year', $year)
                ->count('q1') * 5;

            for ($i = 1; $i <= 20; $i++) {
                $sum = $this->collection->where('year', $year)
                    ->sum('q' . $i);
                $totalScore = $this->collection->where('year', $year)
                    ->count('q' . $i);

                $percentage = $totalScore > 0 ? ($sum / $total) * 100 : 0;
                $percentages['percentage_q' . $i] = $percentage;
            }

            $categories = [
                'category_1' => array_slice($percentages, 0, 5),
                'category_2' => array_slice($percentages, 5, 5),
                'category_3' => array_slice($percentages, 10, 5),
                'category_4' => array_slice($percentages, 15, 5),
            ];

            foreach ($categories as $key => $category) {
                $sum = array_sum($category);
                $totalScore = count($category);
                $percentage = $totalScore > 0 ? ($sum / $totalScore) : 0;
                $categories[$key] = $percentage;
            }
        }
        $data = [];
        foreach ($grouped as $teacher_id => $evaluations) {
            $count = $evaluations->count();
            $total_score = $evaluations->sum('total_score');
            $total =  ($total_score / $count) * 100;
            $teacher_name = User::find($teacher_id)->user_name; // get the name of the teacher

            $data[] = [
                'percentage of teacher' => $total,
                'sections' => $sections,
                'categories' => $categories,
                'percentage' => $percentages,
                'total' => $total_evaluatee,
                'total_students' => $students,
                'total_teacher' => $teachers,
                'teacher_name' => $teacher_name,
                'total_evaluations' => $count,
                'total_score' => $total,
            ];
        }

        // Sort the $data array in descending order based on the 'percentage of teacher' value
        usort($data, function ($a, $b) {
            return $b['percentage of teacher'] <=> $a['percentage of teacher'];
        });



        $sorted = collect($data)->sortByDesc('total_evaluations')->values()->all();

        return $sorted;
    }
};
