<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'subject_rating', 'knowledge_rating', 'teacher_rating', 'comment', 'interpretation_rating'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
