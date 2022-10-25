<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LunchRatingResource extends JsonResource
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
            'food_rating' => $this->food_rating,
            'hygiene_rating' => $this->hygiene_rating,
            'food_variations_rating' => $this->food_variations_rating,
            'comment' => $this->comment,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'lunch' => $this->lunch,
        ];
    }
}
