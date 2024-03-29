<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Home\{
    HomeController,
    EmailTesterController,
    PaymentController,
    Dashboard\CourseController as DashCouseController,
};

use App\Http\Controllers\Admins\DashboardController as AdminDashboard;
use App\Http\Controllers\Admins\AuthController as AdminAuthController;
use App\Http\Controllers\Admins\BlogController;
use App\Http\Controllers\Admins\Master\{
    CatalogController,
    CatalogTopicController,
    LevelController
};
use App\Http\Controllers\Admins\Manage\UserController;
use App\Http\Controllers\Admins\Manage\Partner\{CourseController, UserController as PartnerController};
use App\Http\Controllers\BlogController as PublicBlogController;

use App\Http\Controllers\Partners\{
    ResetPasswordController as ResetPasswordPartner,
    DashboardController as PartnerDashboard,
    AuthController as PartnerAuthController,
    CourseController as PartnerCourseController,
    CorporationController as PartnerCorporationController,
    TransactionController as PartnerTransactionController,
    WithdrawalController as PartnerWithdrawalController,

    Courses\ExperienceController as PartnerExpController,
    Courses\LessonController as PartnerLessonController,

    Courses\Lessons\BookController as BookController,
    Courses\Lessons\VideoController,

    Courses\Lessons\Quizzes\QuestionController,

};

use App\Http\Livewire\Admins\{
    LvRequestWithdrawal as ReqWithdrawalLive,
    LvTransaction as TransactionLive,
};

use App\Http\Livewire\Partners\{
    LvCourseInsert as CourseInsertLive,

    Withdrawals\LvBank as PartnerBankLive,
    LvWithdrawal as WithdrawalLive,

    LvHistoryTransaction as HistoryTransactionLive,

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
    Course as CoursesLive,
    LvCourseDetail as CourseDetailLive,
    LvCertificateVerify as CertificateVerifyLive,
    LvBlogs as BlogsLive,
    Payments\LvPayCourse,
    Reviews\LvReviewCourse as ReviewCourseLive,
    Dashboard\LvDashboard as DashboardLive,
    Dashboard\LvCourse as DashboardCourseLive,
    Dashboard\LvCourseFinish as DashboardCourseFinishLive,
    Dashboard\LvLesson as DashboardLessonLive,
    Dashboard\LvLessonRating as DashboardLessonRatingLive,
    Dashboard\LvQuiz as DashboardQuizLive,
};

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::view('ea', 'auth.verify_password');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('verify/{hash_id}', CertificateVerifyLive::class)->name('home.certificate.verify');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('courses', CoursesLive::class)->name('home.course.index');

Route::get('/blogs', BlogsLive::class)->name('home.blogs.index');

Route::view('certificates', 'homepage.pages.certificates.certificate');
Route::view('certificates/pdf', 'homepage.pages.certificates.certificate_pdf_2');
Route::view('certificates/print', 'homepage.pages.certificates.certificate_print');
Route::get('certificates/download', [HomeController::class, 'pdfCertificate']);
// Route::view('/', 'homepage.pages.index');

Route::get('/learn/{title}', CourseDetailLive::class)->name('home.detail.course');

Route::get('/learn/{title}/reviews', ReviewCourseLive::class)->name('home.detail.course.review');



Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('certificates/download/{uuid}/pdf/{filename}', [HomeController::class, 'getCertificate'])->name('home.certificate.download');
    Route::prefix('dashboard')->name('home.dashboard.')->group(function () {
        Route::get('/home', DashboardLive::class)->name('index');

        Route::get('course/{title}', DashboardCourseFinishLive::class)->name('course');

        Route::get('course/{title}/lesson', DashboardCourseLive::class)->name('course.lesson');

        Route::get('course/{title}/lesson/{lesson_id}', DashboardLessonLive::class)->name('course.lesson.index');

        Route::get('course/{title}/lesson/{lesson_id}/quiz/{quiz_id}', DashboardQuizLive::class)->name('course.lesson.quiz');

        Route::get('course/{title}/lesson/{lesson_id}/rate', DashboardLessonRatingLive::class)->name('course.lesson.rating');
    });
});

Route::middleware(['auth:web', 'verified'])->group(function () {
    // Route::get('learn/{title}/enroll', [PaymentController::class, 'index'])->name('home.course.enroll');
    Route::get('learn/{title}/enroll', LvPayCourse::class)->name('home.course.enroll');
});

Route::middleware(['auth:web', 'verified'])->prefix('ajax/request/')->name('ajax.request.')->group(function () {
    Route::post('lesson/rating', [DashCouseController::class, 'lessonRateItem'])->name('lesson.rating');
});

// Midtrans Notification Handler
Route::post('payments/notification/handler', [PaymentController::class, 'notification']);
Route::get('payments/completed', [PaymentController::class, 'completed']);
Route::get('payments/failed', [PaymentController::class, 'failed']);
Route::get('payments/unfinish', [PaymentController::class, 'unfinish']);


Route::resource('blog', BlogController::class);

// Route::get('/learn/{title}', [HomeController::class, 'detailCourse'])->name('home.detail.course');



Route::view('dashboard', 'dashboard')->middleware(['auth:sanctum', 'verified'])->name('dashboard');

Route::middleware('auth:admin')->prefix('admin/management')->name('admin.')->group(function () {
    Route::put('blog/{id}/mark-as-highlight', [BlogController::class, 'markAsHighlight'])->name(
        'blog.mark-as-highlight'
    );
    Route::resource('blog', BlogController::class);
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('user/{id}/update_status', [UserController::class, 'update_status'])->name('update_status');
    Route::resources([
        'catalog'       => CatalogController::class,
        'catalog_topic' => CatalogTopicController::class,
        'level'         => LevelController::class,
        'user'          => UserController::class,
    ]);
    
    Route::prefix('finance')->name('finance.')->group(function(){
        Route::get('request-withdrawal', ReqWithdrawalLive::class)->name('request.withdrawal');
        Route::get('transaction', TransactionLive::class)->name('transaction');
    });

    Route::prefix('partner')->group(function(){
        Route::get('verif_course/{course_id}/lessons', [CourseController::class, 'lesson'])->name('verif_course.lesson.index');
        Route::resource('verif_course', CourseController::class);
        Route::resource('verif_partner', PartnerController::class);
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
        
        Route::get('course/suggestTopic/{id}', [PartnerCourseController::class, 'suggestTopic'])->name('suggestTopic');
        Route::resource('course', PartnerCourseController::class);
        Route::get('course/create', CourseInsertLive::class)->name('course.create');
        Route::resource('corporation', PartnerCorporationController::class);
        Route::get('transaction/export_pdf/{status}', [PartnerTransactionController::class, 'exportPdf']);
        Route::get('transaction/export_excel/{status}', [PartnerTransactionController::class, 'exportExcel']);
        Route::resource('transaction', PartnerTransactionController::class);

        Route::get('withdrawal', WithdrawalLive::class)->name('withdrawal');
        Route::get('history/transaction', HistoryTransactionLive::class)->name('history.transaction');
        Route::get('withdrawal/bank-accounts', PartnerBankLive::class)->name('withdrawal.bank_account');
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
    Route::get('withdrawals/get/{uuid}/image', [
        PartnerWithdrawalController::class, 'image'
    ])->name('withdrawal.transfer.images');
});

Route::middleware(['auth:web', 'verified'])->prefix('assets/')->name('home.asset.')->group(function (){
    Route::get('lessons/books/get/{uuid}/pdf/{filename}', [
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
Route::post('partner/custom_password', [ResetPasswordPartner::class, 'reset'])->name('password.email');
Route::get('partner/{token}/reset-password', [ResetPasswordPartner::class, 'getPassword']);
Route::post('partner/reset-password', [ResetPasswordPartner::class, 'updatePassword'])->name('partner.updatePassword');
Route::view('test-mail', 'test');

Route::get('/email/view', [EmailTesterController::class, 'index']);
Route::get('/email/send', [EmailTesterController::class, 'sendTester']);