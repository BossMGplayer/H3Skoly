<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use App\Models\Subject;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'file_path' => $this->file_path,
            'field_id' => $this->field_id,
            'average_rating' => $this->averageRating(),
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];

        if ($this->relationLoaded('ratings')) {
            $data['ratings'] = $this->ratings;
        }

        return $data;
    }
}
