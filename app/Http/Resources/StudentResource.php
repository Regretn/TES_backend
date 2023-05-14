<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Section;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $section = Section::find($this->section_id);

        return [
            'id' => $this->id,
            'student_lrn' => $this->student_lrn,
            'section_id' => $this->section_id,
            'section_name' => $section ? $section->section_name : null,
            'user_type' => $this->user_type
        ];
    }
}
