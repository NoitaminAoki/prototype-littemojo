<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    User,
    UserHelpReview,
};

class CustomerCourseRating extends Model
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
        'rating',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function userHelpful($user_id)
    {
        $user = UserHelpReview::where(['review_id' => $this->id, 'user_id' => $user_id])->first();
        return $user;
    }

    public function totalHelpful()
    {
        $total = UserHelpReview::where(['review_id' => $this->id, 'is_helpful' => true])->count();
        return $total;
    }
}
