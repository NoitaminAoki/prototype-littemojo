<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\DashboardController as AdminDashboard;
use App\Http\Controllers\Admins\AuthController as AdminAuthController;
use App\Http\Controllers\Admins\Master\{
    CatalogController, CatalogTopicController, LevelController, UserController
};
use App\Http\Controllers\Partners\{
    DashboardController as PartnerDashboard,
    AuthController as PartnerAuthController,
    CourseController as PartnerCourseController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin/management', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard'); 
    Route::get('user/{id}/update_status', [UserController::class, 'update_status'])->name('update_status');   
    Route::resources([
        'catalog'       => CatalogController::class,
        'catalog_topic' => CatalogTopicController::class,
        'level'         => LevelController::class,
        'user'          => UserController::class,
    ]);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/register', [AdminAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register');

    Route::middleware('guest:admin')->get('/login', [AdminAuthController::class, 'loginForm'])->name('login.form');
    Route::middleware('guest:admin')->post('/login', [AdminAuthController::class, 'login'])->name('login');

});


Route::group(['middleware' => 'auth:partner', 'prefix' => 'partner/management', 'as' => 'partner.'], function () {
    Route::get('/dashboard', [PartnerDashboard::class, 'index'])->name('dashboard');

    Route::post('/logout', [PartnerAuthController::class, 'logout'])->name('logout');

    Route::group(['as' => 'manage.' ], function () {
        Route::get('/course', [PartnerCourseController::class, 'index'])->name('course');
    });
});

Route::group(['prefix' => 'partner', 'as' => 'partner.'], function () {
    Route::get('/register', [PartnerAuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [PartnerAuthController::class, 'register'])->name('register');

    Route::middleware('guest:partner')->get('/login', [PartnerAuthController::class, 'loginForm'])->name('login.form');
    Route::middleware('guest:partner')->post('/login', [PartnerAuthController::class, 'login'])->name('login');

});








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