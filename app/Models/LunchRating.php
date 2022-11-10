<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchRating extends Model
{
    use HasFactory;

    protected $fillable = ['lunch_id', 'hygiene_rating', 'food_quality_rating', 'food_variety_rating', 'comment'];

    public function lunch()
    {
        return $this->belongsTo(Lunch::class);
    }
}
