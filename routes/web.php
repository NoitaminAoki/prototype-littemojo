<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;

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

    Courses\ExperienceController as PartnerExpController,
    Courses\LessonController as PartnerLessonController,

    Courses\Lessons\BookController as BookController,
    Courses\Lessons\VideoController,

    Courses\Lessons\Quizzes\QuestionController,

};

use App\Http\Livewire\Partners\{
    Courses\Experience as PartnerExpLive,
    Courses\Skill as PartnerSkillLive,
    Courses\Lesson as PartnerLessonLive,

    Courses\Lessons\Book as BookLive,
    Courses\Lessons\Video as VideoLive,
    Courses\Lessons\Quiz as QuizLive,
    Courses\Lessons\Quizzes\LvQuestion as QuestionLive,
};

use Illuminate\Support\Facades\Auth;

// Route::view('/', 'homepage.pages.index');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::view('dashboard', 'dashboard')->middleware(['auth:sanctum', 'verified'])->name('dashboard');

Route::middleware('auth:admin')->prefix('admin/management')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('user/{id}/update_status', [UserController::class, 'update_status'])->name(
        'update_status'
    );
    Route::resources([
        'catalog'       => CatalogController::class,
        'catalog_topic' => CatalogTopicController::class,
        'level'         => LevelController::class,
        'user'          => UserController::class,
    ]);
    Route::prefix('partner')->group(function(){
        Route::resource('verif_course', CourseController::class);
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

Route::group(['middleware' => 'auth:partner', 'prefix' => 'partner/management', 'as' => 'partner.'], function () {
    Route::get('/dashboard', [PartnerDashboard::class, 'index'])->name('dashboard');

    Route::post('/logout', [PartnerAuthController::class, 'logout'])->name('logout');

    Route::group(['as' => 'manage.' ], function () {
        Route::group(['as' => 'course.', 'prefix' => 'course'], function () {
            Route::get('/{course_id}/experiences', PartnerExpLive::class)->name('experience.index');
            Route::get('/{course_id}/skills', PartnerSkillLive::class)->name('skill.index');
            
            Route::get('/{course_id}/lessons', PartnerLessonLive::class)->name('lesson.index');
            
            Route::group(['prefix' => 'lessons', 'as' => 'lesson.'], function () {
                Route::get('/{lesson:id}', [PartnerLessonController::class, 'show'])->name('show');
                Route::get('/{lesson:id}/books', BookLive::class)->name('book.index');
                Route::get('/{lesson:id}/videos', VideoLive::class)->name('video.index');
                Route::get('/{lesson:id}/quizzes', QuizLive::class)->name('quiz.index');
                Route::get('/quiz/{quiz:id}/questions', QuestionLive::class)->name('quiz.question.index');

            });
        });
        Route::resource('course', PartnerCourseController::class);
    });
});

Route::prefix('partner')->name('partner.')->group(function () {
    Route::get('/register', [PartnerAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [PartnerAuthController::class, 'register'])->name('register');
    Route::middleware('guest:partner')->get('/login', [PartnerAuthController::class, 'loginForm'])->name('login.form');
    Route::middleware('guest:partner')->post('/login', [PartnerAuthController::class, 'login'])->name('login');
    
});
Route::middleware('auth:partner')->get('lessons/books/get/{uuid}/pdf', [BookController::class, 'index'])->name('lesson.books');
Route::middleware('auth:partner')->get('lessons/videos/get/{uuid}/video', [VideoController::class, 'index'])->name('lesson.videos');

Route::middleware('auth:partner')->get('quizzes/questions/get/{uuid}/image', [QuestionController::class, 'index'])->name('question.images');
Route::middleware('auth:partner')->get('quizzes/questions/options/get/{uuid}/image', [QuestionController::class, 'optionIndex'])->name('question.option.images');

Route::get('pass-login-admin', function () {
    $credentials = ['email' => 'admin@admin.com', 'password' => 'Password123'];

    if (Auth::guard('admin')->attempt($credentials)) {
        // if success login
        return redirect('admin/management/dashboard');
        //return redirect()->intended('/details');
    }
    return redirect('login');
});
