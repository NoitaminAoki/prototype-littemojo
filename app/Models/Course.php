<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    GainedExperience as Experiences,
    CourseSkill as Skills,
    CourseLesson as Lesson,
    Catalog,
    Partner,
    Corporation,
    CustomerTransaction as UserTransaction,
    CustomerCourseProgress as UserCourseProgress,
    CustomerCertificate as UserCertificate,
    CatalogTopic,
    Level
};
use DB;
use DateTime;
use DateTimeZone;

class Course extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'catalog_id',
        'catalog_topic_id',
        'level_id',
        'title',
        'slug_title',
        'description',
        'price',
        'duration',
        'uuid',
        'cover',
        'is_verified',
        'is_published',
        'date_verified',
    ];
    
    public function corporation()
    {
        return $this->hasOneThrough(
            Corporation::class,
            Partner::class,
            'id',
            'partner_id',
            'user_id',
            'id'
        );
    }

    public function experiences()
    {
        return $this->hasMany(Experiences::class, 'course_id');
    }
    
    public function skills()
    {
        return $this->hasMany(Skills::class, 'course_id');
    }
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    public function catalog(Type $var = null)
    {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }

    public function isFinished($user_id)
    {
        $lesson = Lesson::selectRaw('COUNT(course_lessons.id) as total_lesson, COUNT(ccp.id) as completed_lesson')
        ->leftJoin('customer_course_progress as ccp', function($join) use($user_id) {
            $join->on('ccp.course_id', '=', 'course_lessons.course_id')
            ->on('ccp.lesson_id', '=', 'course_lessons.id')
            ->where('ccp.customer_id', '=', $user_id);
        })
        ->where('course_lessons.course_id', $this->id)
        ->first();
        
        if($lesson) {
            if($lesson->total_lesson == $lesson->completed_lesson) {
                return true;
            }
        }
        return false;
    }

    public function getProgress($user_id)
    {
        $lesson = Lesson::selectRaw('COUNT(course_lessons.id) as total_lesson, COUNT(ccp.id) as completed_lesson')
        ->leftJoin('customer_course_progress as ccp', function($join) use($user_id) {
            $join->on('ccp.course_id', '=', 'course_lessons.course_id')
            ->on('ccp.lesson_id', '=', 'course_lessons.id')
            ->where('ccp.customer_id', '=', $user_id);
        })
        ->where('course_lessons.course_id', $this->id)
        ->first();

        $data['percent'] = ($lesson->completed_lesson/$lesson->total_lesson) * 100;
        $data['total_lesson'] = $lesson->total_lesson;
        $data['completed_lesson'] = $lesson->completed_lesson;

        return (object)$data;
    }

    public function isAccessible($user_id)
    {
        $date_now = new DateTime("now", new DateTimeZone('Asia/Jakarta') );
        $transaction = UserTransaction::where(['customer_id' => $user_id, 'course_id' => $this->id, 'status_payment' => 'settlement'])->first();
        if($transaction) {
            $start_date = new DateTime($transaction->start_date, new DateTimeZone('Asia/Jakarta'));
            if($start_date <= $date_now) {
                return true;
            }
        }
        return false;
    }

    public function getAccess($user_id)
    {
        $date_now = new DateTime("now", new DateTimeZone('Asia/Jakarta') );
        $transaction = UserTransaction::where(['customer_id' => $user_id, 'course_id' => $this->id, 'status_payment' => 'settlement'])->first();
        if($transaction) {
            $start_date = new DateTime($transaction->start_date, new DateTimeZone('Asia/Jakarta'));
            $end_date = new DateTime($transaction->start_date, new DateTimeZone('Asia/Jakarta'));
            if($this->duration == 'week') {
                $end_date->modify("+7 days");
            } 
            else if($this->duration == 'month') {
                $end_date->modify("+30 days");
            }
            if($start_date <= $date_now) {
                if($date_now > $end_date) {
                    return (object) ['status' => 'expired', 'status_number' => 3];
                } else {
                    return (object) ['status' => 'accessible', 'status_number' => 2];
                }
            } else {
                return (object) ['status' => 'inaccessible', 'status_number' => 1];
            }
        }
        return (object) ['status' => 'restricted', 'status_number' => 0];
    }

    public function isPurchased($user_id)
    {
        $transaction = UserTransaction::where(['customer_id' => $user_id, 'course_id' => $this->id, 'status_payment' => 'settlement'])->first();
        if($transaction) {
            return true;
        }
        return false;
    }

    public function getDateTransaction($user_id)
    {
        $transaction = DB::table('customer_transactions as ct')
        ->select('ct.course_id', 'course.duration', 'ct.start_date')
        ->selectRaw('ADDDATE(ct.start_date, INTERVAL (IF(course.duration = "week", 7, 30)) DAY) as end_date')
        ->leftJoin('courses as course', 'course.id', '=', 'ct.course_id')
        ->where(['ct.course_id' => $this->id, 'ct.customer_id' => $user_id])
        ->first();

        return $transaction;
    }

    public function catalogTopic()
    {
        return $this->belongsTo(CatalogTopic::class, 'catalog_topic_id')->select('id', 'name');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id')->select('id', 'name');
    }

    public function getCustomerCertificate($user_id)
    {
        $certificate = UserCertificate::where(['customer_id' => $user_id, 'course_id' => $this->id])->first();

        return $certificate;
    }
}
