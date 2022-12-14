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
}
