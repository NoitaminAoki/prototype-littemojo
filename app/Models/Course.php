<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GainedExperience as Experiences;

class Course extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function experiences()
    {
        return $this->hasMany(Experiences::class, 'course_id');
    }
}
