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
    Route::middleware(['gues:admin'])->group(function () {
        Route::get('login', [AdminAuthController::class, 'loginForm'])->name('login.form');
        Route::post('login', AdminAuthController::class, 'login')->name('login');
    });
});

Route::middleware(['auth:partner'])->prefix('partner/management')->name('partner.')
    ->group(function () {
        Route::get('/dashboard', [PartnerDashboard::class, 'index'])->name('dashboard');
        Route::post('/logout', [PartnerAuthController::class, 'logout'])->name('logout');
        Route::name('manage.')->group(function () {
            Route::resource('course', PartnerCourseController::class);
        });
    });

Route::prefix('partner')->name('partner.')->group(function () {
    Route::get('/register', [PartnerAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [PartnerAuthController::class, 'register'])->name('register');
    Route::middleware(['guest:partner'])->group(function () {
        Route::get('login', [PartnerAuthController::class, 'loginForm'])->name('login.form');
        Route::post('login', [PartnerAuthController::class, 'login'])->name('login');
    });
});

// auth login

Route::get('pass-login', function () {
    $credentials = ['email' => 's2.DanielAoki@gmail.com', 'password' => 'Password123'];

    if (Auth::attempt($credentials)) {
        // if success login
        return redirect('dashboard');
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
