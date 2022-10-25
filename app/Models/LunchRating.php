<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchRating extends Model
{
    use HasFactory;

    protected $fillable = ['lunch_id', 'food_rating', 'hygiene_rating', 'food_variations_rating', 'comment'];

    public function lunch()
    {
        return $this->belongsTo(Lunch::class);
    }
}
