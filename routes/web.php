<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\{
    HomeController,
    PaymentController,
    Dashboard\CourseController as DashCouseController,
};

use App\Http\Controllers\Admins\DashboardController as AdminDashboard;
use App\Http\Controllers\Admins\AuthController as AdminAuthController;
use App\Http\Controllers\Admins\Master\{
    CatalogController,
    CatalogTopicController,
    LevelController
};
use App\Http\Controllers\Admins\Manage\UserController;
use App\Http\Controllers\Admins\Manage\Partner\CourseController;
use App\Http\Controllers\Partners\{
    DashboardController as PartnerDashboard,
    AuthController as PartnerAuthController,
    CourseController as PartnerCourseController,
    CorporationController as PartnerCorporationController,

    Courses\ExperienceController as PartnerExpController,
    Courses\LessonController as PartnerLessonController,

    Courses\Lessons\BookController as BookController,
    Courses\Lessons\VideoController,

    Courses\Lessons\Quizzes\QuestionController,

};

use App\Http\Livewire\Partners\{
    LvCourseInsert as CourseInsertLive,

    Courses\Experience as PartnerExpLive,
    Courses\Skill as PartnerSkillLive,
    Courses\Lesson as PartnerLessonLive,

    Courses\Lessons\LvLearningSequenceProto as LearningSequenceLive,
    Courses\Lessons\Book as BookLive,
    Courses\Lessons\Video as VideoLive,
    Courses\Lessons\Quiz as QuizLive,
    Courses\Lessons\Quizzes\LvQuestion as QuestionLive,
};

use App\Http\Livewire\Homepages\{
    Payments\LvPayCourse,
    Dashboard\LvCourse as DashboardCourseLive,
};

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Route::view('/', 'homepage.pages.index');

Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::prefix('dashboard')->name('home.dashboard.')->group(function () {
        Route::get('course/{title}', DashboardCourseLive::class)->name('course');
    });
});

// Midtrans Notification Handler
Route::post('payments/notification/handler', [PaymentController::class, 'notification']);
Route::get('payments/completed', [PaymentController::class, 'completed']);
Route::get('payments/failed', [PaymentController::class, 'failed']);
Route::get('payments/unfinish', [PaymentController::class, 'unfinish']);

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/learn/{title}', [HomeController::class, 'detailCourse'])->name('home.detail.course');

Route::middleware(['auth:web'])->group(function () {
    // Route::get('learn/{title}/enroll', [PaymentController::class, 'index'])->name('home.course.enroll');
    Route::get('learn/{title}/enroll', LvPayCourse::class)->name('home.course.enroll');
});


Route::view('dashboard', 'dashboard')->middleware(['auth:sanctum', 'verified'])->name('dashboard');

Route::middleware('auth:admin')->prefix('admin/management')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('user/{id}/update_status', [UserController::class, 'update_status'])->name('update_status');
    Route::resources([
        'catalog'       => CatalogController::class,
        'catalog_topic' => CatalogTopicController::class,
        'level'         => LevelController::class,
        'user'          => UserController::class,
    ]);
    Route::prefix('partner')->group(function(){
        Route::get('verif_course/{course_id}/lessons', [CourseController::class, 'lesson'])->name('verif_course.lesson.index');
        Route::resource('verif_course', CourseController::class);
        Route::get('lessons/{lesson:id}', [CourseController::class, 'detailLesson'])->name('lessons.show');
        Route::get('lessons/{lesson:id}/quizzes', [CourseController::class, 'quiz'])->name('quiz.show');
        Route::get('lessons/quiz/{quiz:id}/questions', [CourseController::class, 'detailQuiz'])->name('quiz.detail');
        Route::get('lessons/books/get/{uuid}/pdf', [
            CourseController::class, 'book'
        ])->name('lesson.books');
        Route::get('lessons/videos/get/{uuid}/video', [
            CourseController::class, 'video'
        ])->name('lesson.videos');
    });
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/register', [AdminAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register');
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('login', [AdminAuthController::class, 'loginForm'])->name('login.form');
        Route::post('login', [AdminAuthController::class, 'login'])->name('login');
    });
});

Route::group([
    'middleware' => 'auth:partner',
    'prefix' => 'partner/management',
    'as' => 'partner.'
], function () {
    Route::get('/dashboard', [PartnerDashboard::class, 'index'])->name('dashboard');

    Route::post('/logout', [PartnerAuthController::class, 'logout'])->name('logout');

    Route::group(['as' => 'manage.' ], function () {
        Route::group(['as' => 'course.', 'prefix' => 'course'], function () {
            Route::get('/{course_id}/experiences', PartnerExpLive::class)->name('experience.index');
            Route::get('/{course_id}/skills', PartnerSkillLive::class)->name('skill.index');
            
            Route::get('/{course_id}/lessons', PartnerLessonLive::class)->name('lesson.index');
            
            Route::group(['prefix' => 'lessons', 'as' => 'lesson.'], function () {
                Route::get('/{lesson:id}', [PartnerLessonController::class, 'show'])->name('show');
                Route::get('/{lesson:id}/learning-sequences', LearningSequenceLive::class)->name('learning.sequence.index');
                Route::get('/{lesson:id}/books', BookLive::class)->name('book.index');
                Route::get('/{lesson:id}/videos', VideoLive::class)->name('video.index');
                Route::get('/{lesson:id}/quizzes', QuizLive::class)->name('quiz.index');
                Route::get('/quiz/{quiz:id}/questions', QuestionLive::class)->name(
                    'quiz.question.index'
                );

            });
        });
        Route::get('course/publish/{id}', [PartnerCourseController::class, 'publish'])->name('publish');
        
        Route::get('course/insert', CourseInsertLive::class);
        Route::resource('course', PartnerCourseController::class);
        Route::resource('corporation', PartnerCorporationController::class);
    });
});

Route::prefix('partner')->name('partner.')->group(function () {
    Route::get('/register', [PartnerAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [PartnerAuthController::class, 'register'])->name('register');
    Route::middleware(['guest:partner'])->group(function () {
        Route::get('/login', [PartnerAuthController::class, 'loginForm'])->name('login.form');
        Route::post('/login', [PartnerAuthController::class, 'login'])->name('login');
    });
    
});


Route::middleware(['auth:partner'])->group(function (){
    Route::get('lessons/books/get/{uuid}/pdf', [
        BookController::class, 'index'
    ])->name('lesson.books');
    Route::get('lessons/videos/get/{uuid}/video', [
        VideoController::class, 'index'
    ])->name('lesson.videos');
    Route::get('quizzes/questions/get/{uuid}/image', [
        QuestionController::class, 'index'
    ])->name('question.images');
    Route::get('quizzes/questions/options/get/{uuid}/image', [
        QuestionController::class, 'optionIndex'
    ])->name('question.option.images');
});

Route::get('pass-login-admin', function () {
    $credentials = ['email' => 'admin@admin.com', 'password' => 'Password123'];

    if (Auth::guard('admin')->attempt($credentials)) {
        // if success login
        return redirect('admin/management/dashboard');
        //return redirect()->intended('/details');
    }
    return redirect('login');
});
