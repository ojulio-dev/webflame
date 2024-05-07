<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VideoStatusController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\InteractionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/auth')->group(function() {

    Route::post('/login', [AuthController::class, 'authLogin'])->name('authLogin');

    Route::post('/register', [AuthController::class, 'authRegister'])->name('authRegister');

    Route::get('/logout', [AuthController::class, 'logout'])->name('authLogout');

});

Route::prefix('user')->group(function() {

    Route::post('/update', [UserController::class, 'update']);

    Route::get('/{id}/videos', [UserController::class, 'listVideosByUserId']);

});

Route::prefix('video')->group(function() {

    Route::get('/', [VideoController::class, 'listVideos']);

    Route::post('/create', [VideoController::class, 'createVideo']);

    Route::get('/{id}', [VideoController::class, 'findVideoById']);

    Route::post('/update', [VideoController::class, 'updateVideo']);

    Route::post('/updateStatus/{id}', [VideoController::class, 'updateStatus'])->where('id', '[1-4]');

    Route::post('/delete', [VideoController::class,'delete']);

    Route::get('/{videoId}/comments', [CommentController::class, 'index']);

    Route::get('/{videoId}/interactions', [InteractionController::class, 'listInteractionsByVideo']);

});

Route::post('/searchPreview', [HomeController::class, 'searchPreview']);

Route::prefix('/reports')->group(function() {

    Route::post('/video', [ReportController::class, 'reportVideo']);

    Route::post('/user', [ReportController::class, 'reportUser']);

    Route::get('/video/{videoId}/user/{userId}', [ReportController::class, 'validateReportVideo']);

    Route::get('/user/{reportedUser}/{reportingUser}', [ReportController::class, 'validateReportUser']);

});

Route::prefix('videoStatus')->group(function() {

    Route::get('{id}', [VideoStatusController::class, 'findVideosByStatusId']);

});

Route::prefix('reportedVideos')->group(function() {

    Route::get('/', [ReportController::class, 'getReportedVideos']);

    Route::get('/{id}/removeVideo', [ReportController::class, 'removeReportedVideo']);

    Route::get('/{id}/allowVideo', [ReportController::class, 'allowReportedVideo']);

    Route::get('{id}', [ReportController::class, 'getReportedVideo']);

});

Route::prefix('reportedUsers')->group(function() {

    Route::get('/', [ReportController::class, 'getReportedUsers']);

    Route::get('/{id}/removeUser', [ReportController::class, 'removeReportedUser']);

    Route::get('/{id}/allowUser', [ReportController::class, 'allowReportedUser']);

    Route::get('{id}', [ReportController::class, 'getReportedUser']);

});

Route::prefix('comment')->group(function() {

    Route::post('/create', [CommentController::class, 'create']);

});

Route::prefix('subscribe')->group(function() {

    Route::post('/create', [SubscriberController::class, 'create']);

    Route::post('/delete', [SubscriberController::class, 'destroy']);

});

Route::prefix('interaction')->group(function() {

    Route::post('/create', [InteractionController::class, 'create']);

    Route::post('/delete', [InteractionController::class, 'destroy']);

});