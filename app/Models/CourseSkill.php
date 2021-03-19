<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSkill extends Model
{
    use HasFactory;

    public function Skill(){
    	return $this->belongsTo('App\Models\ObtainSkill', 'skill_id', 'id');
    }
}
