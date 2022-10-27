<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'file_path', 'type'];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function lunch()
    {
        return $this->hasOne(Lunch::class);
    }
}
