<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    GainedExperience as Experiences,
    ObtainSkill as Skills,
};

class Course extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function experiences()
    {
        return $this->hasMany(Experiences::class, 'course_id');
    }

    public function skills()
    {
        return $this->hasMany(Skills::class, 'course_id');
    }
}
