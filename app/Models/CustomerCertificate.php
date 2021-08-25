<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Course,
};

class CustomerCertificate extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'course_id',
        'uuid',
        'hash_id',
        'filename',
        'path',
    ];
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
