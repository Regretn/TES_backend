<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $percentages = [];
        $categories = [];

        $year = $request->input('year') ?? date('Y');

        if (!is_null($this->resource)) {
            $total = $this->resource->whereYear('created_at', $year)->count('q1') * 5;

            for ($i = 1; $i <= 20; $i++) {
                $sum = $this->whereYear('created_at', $year)->sum('q' . $i);
                $totalScore = $this->whereYear('created_at', $year)->count('q' . $i);
                $percentage = $totalScore > 0 ? ($sum / $total) * 100 : 0;
                $percentages['percentage_q' . $i] = $percentage;
            }

            // Categorize questions into 4 groups
            $categories = [
                'category_1' => array_slice($percentages, 0, 5),
                'category_2' => array_slice($percentages, 5, 5),
                'category_3' => array_slice($percentages, 10, 5),
                'category_4' => array_slice($percentages, 15, 5),
            ];

            // Calculate percentage for each category
            foreach ($categories as $key => $category) {
                $sum = array_sum($category);
                $totalScore = count($category);
                $percentage = $totalScore > 0 ? ($sum / $totalScore) : 0;
                $categories[$key] = $percentage;
            }
        }

        return array_merge([
            'id' => $this->id,
            'q1' => $this->q1,
            'q2' => $this->q2,
            'q3' => $this->q3,
            'q4' => $this->q4,
            'q5' => $this->q5,
            'q6' => $this->q6,
            'q7' => $this->q7,
            'q8' => $this->q8,
            'q9' => $this->q9,
            'q10' => $this->q10,
            'q11' => $this->q11,
            'q12' => $this->q12,
            'q13' => $this->q13,
            'q14' => $this->q14,
            'q15' => $this->q15,
            'q16' => $this->q16,
            'q17' => $this->q17,
            'q18' => $this->q18,
            'q19' => $this->q19,
            'q20' => $this->q20,
            'comment' => $this->comment,
            'teacher_id' => $this->teacher_id,
            'total_score' => $this->total_score,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ], $percentages, $categories);
    }
}
