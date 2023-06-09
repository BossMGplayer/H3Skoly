<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'type', 'file_path'];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function lunch()
    {
        return $this->hasOne(Lunch::class);
    }

    public function averageLunchRating()
    {
        if ($this->lunch) {
            return $this->lunch->averageRating();
        }

        return null;
    }

    /**
     * Calculate the average rating of the school based on its fields and lunch
     *
     * @return float|null
     */
    public function calculateSchoolRating()
    {
        $fieldCount = $this->fields()->count();
        $fieldAverage = $this->fields->avg(function ($field) {
            return $field->averageRating();
        });

        if ($fieldCount === 0) {
            return null;
        }

        $lunchRating = $this->averageLunchRating();

        if ($lunchRating === null) {
            return $fieldAverage;
        }


        return ($lunchRating + $fieldAverage) / ($fieldCount + 1);
    }
}
