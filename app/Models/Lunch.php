<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'school_id','file_path'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function ratings()
    {
        return $this->hasMany(LunchRating::class);
    }

    /**
     * Calculate the average rating of a teacher
     *
     * @return integer
     */
    public function averageFoodRating()
    {
        $ratings = $this->ratings;

        if (!$ratings->isEmpty()) {
            $sum = 0;

            foreach ($ratings as $rating) {
                $sum += $rating->food_rating;
            }
            $averageFoodRating = $sum / $ratings->count();
            return $averageFoodRating;
        }
    }

    /**
     * Calculate the average rating of a subject
     *
     * @return integer
     */
    public function averageHygieneRating()
    {
        $ratings = $this->ratings;

        if (!$ratings->isEmpty()) {
            $sum = 0;

            foreach ($ratings as $rating) {
                $sum += $rating->hygiene_rating;
            }
            $averageHygieneRating = $sum / $ratings->count();
            return $averageHygieneRating;
        }
    }

    /**
     * Calculate the average rating on knowlegde
     *
     * @return integer
     */
    public function averageVarietyRating()
    {
        $ratings = $this->ratings;

        if (!$ratings->isEmpty()) {
            $sum = 0;

            foreach ($ratings as $rating) {
                $sum += $rating->food_variations_rating;
            }
            $averageVarietyRating = $sum / $ratings->count();
            return $averageVarietyRating;
        }
    }

    /**
     * Calculate the average rating on a subject
     *
     * @return integer
     */
    public function averageRating()
    {
        $averageRatingPlace = $this->averageFoodRating() + $this->averageHygieneRating() + $this->averageVarietyRating();
        $averageRating = $averageRatingPlace/3;

        return $averageRating;
    }

}
