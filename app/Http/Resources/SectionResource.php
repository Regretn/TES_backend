<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'teacher_name' => $this->teacher_name,
            'user_name' => $this->user_name,
            'password' => $this->password,
            'email' => $this->email,
            'image' => $this->image,
            'description' => $this->description,
            'section' => SectionResource::collection($this->whenLoaded('sections')),
            'evaluated' => $this->evaluated,
        ];
    }
}
