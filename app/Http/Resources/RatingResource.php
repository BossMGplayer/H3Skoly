<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'subject_rating' => $this->subject_rating,
            'teacher_rating' => $this->teacher_rating,
            'knowledge_rating' => $this->knowledge_rating,
            'comment' => $this->comment,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'subject' => $this->subject,
        ];
    }
}
