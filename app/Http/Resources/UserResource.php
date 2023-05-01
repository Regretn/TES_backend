<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $evaluated = $this->resource['evaluated'] ?? 0;

        return [
            'id' => $this->id,
            'teacher_name' => $this->teacher_id,
            'user_name' => $this->user_name,
            'password' => $this->password,
            'email' => $this->email,
            'image' => $this->image,
            'description' => $this->description,
            'section_id' => $this->section_id,
            'evaluated' => $evaluated
        ];
    }
}
