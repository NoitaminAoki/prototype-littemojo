<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\AuthController;

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



Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'name' => 'admin.'], function () {
    Route::get('/management/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
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