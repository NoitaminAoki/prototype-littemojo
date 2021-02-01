<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\DashboardController as AdminDashboard;
use App\Http\Controllers\Admins\AuthController as AdminAuthController;
use App\Http\Controllers\Admins\Master\{
    CatalogController,
    CatalogTopicController,
    LevelController
};
use App\Http\Controllers\Admins\Manage\UserController;
use App\Http\Controllers\Partners\{
    DashboardController as PartnerDashboard,
    AuthController as PartnerAuthController,
    CourseController as PartnerCourseController,
    Courses\ExperienceController as PartnerExpController,
};

use App\Http\Livewire\Partners\{
    Courses\Experience as PartnerExpLive,
};
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');
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
            Route::get('/experiences/{course_id}', PartnerExpLive::class)->name('experience.index');
        });
        Route::resource('course', PartnerCourseController::class);
    });

Route::prefix('partner')->name('partner.')->group(function () {
    Route::get('/register', [PartnerAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [PartnerAuthController::class, 'register'])->name('register');
    Route::middleware('guest:partner')->get('/login', [PartnerAuthController::class, 'loginForm'])->name('login.form');
    Route::middleware('guest:partner')->post('/login', [PartnerAuthController::class, 'login'])->name('login');
    
});







});
Route::get('pass-login-partner', function () {
    $credentials = ['email' => 'partner1@mail.com', 'password' => 'Password123'];

    if (Auth::guard('partner')->attempt($credentials)) {
        // if success login
        return redirect('partner/management/dashboard');
        //return redirect()->intended('/details');
    }
    return redirect('login');
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
