<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';
    protected $fillable = [
        'title',
        'img',
        'content',
        'is_publish',
        'is_highlight',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
