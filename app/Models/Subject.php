<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'field_id','file_path'];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Calculate the average rating of a teacher
     *
     * @return integer
     */
    public function averageTeacherRating()
    {
        $ratings = $this->ratings;

        if (!$ratings->isEmpty()) {
            $sum = 0;

            foreach ($ratings as $rating) {
                $sum += $rating->teacher_rating;
            }
            $averageTeacherRating = $sum / $ratings->count();
            return $averageTeacherRating;
        }
    }

    /**
     * Calculate the average rating of a subject
     *
     * @return integer
     */
    public function averageSubjectRating()
    {
        $ratings = $this->ratings;

        if (!$ratings->isEmpty()) {
            $sum = 0;

            foreach ($ratings as $rating) {
                $sum += $rating->subject_rating;
            }
            $averageSubjectRating = $sum / $ratings->count();
            return $averageSubjectRating;
        }
    }

    /**
     * Calculate the average rating on knowlegde
     *
     * @return integer
     */
    public function averageKnowledgeRating()
    {
        $ratings = $this->ratings;

        if (!$ratings->isEmpty()) {
            $sum = 0;

            foreach ($ratings as $rating) {
                $sum += $rating->knowledge_rating;
            }
            $averageKnowledgeRating = $sum / $ratings->count();
            return $averageKnowledgeRating;
        }
    }

    /**
     * Calculate the average rating on interpretion
     *
     * @return integer
     */
    public function averageInterpretationRating()
    {
        $ratings = $this->ratings;

        if (!$ratings->isEmpty()) {
            $sum = 0;

            foreach ($ratings as $rating) {
                $sum += $rating->interpretation_rating;
            }
            $averageInterpretionRating = $sum / $ratings->count();
            return $averageInterpretionRating;
        }
    }

    /**
     * Calculate the average rating on a subject
     *
     * @return integer
     */
    public function averageRating()
    {
        $averageRatingPlace = $this->averageTeacherRating() + $this->averageKnowledgeRating() + $this->averageSubjectRating() + $this->averageInterpretationRating();
        $averageRating = $averageRatingPlace/4;

        return $averageRating;
    }

}
