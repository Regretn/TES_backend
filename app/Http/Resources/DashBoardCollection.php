<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

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

        $data = [];

        foreach ($grouped as $teacher_id => $evaluations) {
            $count = $evaluations->count();
            $total_score = $evaluations->sum('total_score');

            $data[] = [
                'teacher_id' => $teacher_id,
                'total_evaluations' => $count,
                'total_score' => $total_score,
                'percentage' => $count / $this->collection->count() * 100
            ];
        }

        $sorted = collect($data)->sortByDesc('total_evaluations')->values()->all();

        return $sorted;
    }
}
