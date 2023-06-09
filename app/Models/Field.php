<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'school_id', 'file_path'];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Calculate the average rating on a field
     *
     * @return integer
     */
    public function averageRating()
    {
        $associatedSubjects = $this->subjects;
        $averageRatingPlaceholder = 0;

        if ($associatedSubjects->isNotEmpty()) {
            foreach ($associatedSubjects as $subject) {
                $averageRatingPlaceholder += $subject->averageRating();
            }
            $averageRating = $averageRatingPlaceholder / $associatedSubjects->count();
            return $averageRating;
        }

        return 0;
    }
}
