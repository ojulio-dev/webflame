<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('checkLoggedIn')->group(function() {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/watch', [HomeController::class, 'watch'])->name('watch');

    Route::get('/search', [HomeController::class, 'search'])->name('search');

    // Profile
    Route::prefix('user')->group(function() {

        Route::get('/profile', [UserController::class, 'index'])->name('profile');

        Route::get('/profile/videos', [UserController::class, 'videos'])->name('videos');

        Route::get('/{username}', [UserController::class, 'findUser'])->name('findUser');

    });


    // Admin
    Route::prefix('admin')->group(function() {

        Route::get('/', [AdminHomeController::class, 'index'])->name('admin-home');

        Route::get('/users', [AdminUserController::class, 'index'])->name('admin-users');
        
        Route::get('/videos', [AdminVideoController::class, 'index'])->name('admin-videos');

    });
});

Route::middleware('checkGuest')->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
});
