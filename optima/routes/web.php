<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ConferencesController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\TopicsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::name('password.')->group(function () {
        Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('email');

        Route::get('/reset-password', [ResetPasswordController::class, 'create'])->name('reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('update');
    });    
});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PostsController::class, 'index'])->name('dashboard');
    Route::get('/post/{id}-{slug}', [PostsController::class, 'show'])->name('post.show');
    Route::get('/conference', [ConferencesController::class, 'index'])->name('conference');
   
    Route::post('/update-profile-image', [ProfilesController::class, 'updateProfileImage']);
    Route::post('/update-background-image', [ProfilesController::class, 'updateBackgroundImage']);

    Route::prefix('/user-profile')->name('profile.')->group(function () {
        Route::get('/', [ProfilesController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [ProfilesController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [ProfilesController::class, 'update']);
        Route::post('/update-profile-image', [ProfilesController::class, 'updateProfileImage']);
        Route::post('/update-background-image', [ProfilesController::class, 'updateBackgroundImage']);
    });

    Route::prefix('/participant')->name('participant.')->group(function () {
        Route::get('/', [ParticipantsController::class, 'index'])->name('index');
        Route::post('/create', [ParticipantsController::class, 'store']);
    });

    Route::middleware('check.role')->group(function () {
        Route::prefix('/post')->name('post.')->group(function () {
            Route::get('/admin', [PostsController::class, 'indexAdmin'])->name('admin');
            Route::get('/create', [PostsController::class, 'create'])->name('create');
            Route::post('/create', [PostsController::class, 'store']);
            Route::get('/edit/{id}-{slug}', [PostsController::class, 'edit'])->name('edit');
            Route::put('/edit/{id}', [PostsController::class, 'update']);
            Route::delete('/delete/{id}', [PostsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('/conference')->name('conference.')->group(function () {
            Route::get('/admin', [ConferencesController::class, 'indexAdmin'])->name('admin');
            Route::get('/create', [ConferencesController::class, 'create'])->name('create');
            Route::post('/create', [ConferencesController::class, 'store']);
            Route::get('/edit/{id}', [ConferencesController::class, 'edit'])->name('edit');
            Route::put('/edit/{id}', [ConferencesController::class, 'update']);
            Route::delete('/delete/{id}', [ConferencesController::class, 'destroy'])->name('delete');
            Route::post('/set-active', [ConferencesController::class, 'setActiveById'])->name('setActiveById');
            Route::post('/set-in-active', [ConferencesController::class, 'setInactiveById'])->name('setInactiveById');
        });

        Route::prefix('/conference/{conference_id}/topics')->name('topic.')->group(function () {
            Route::get('/', [TopicsController::class, 'index'])->name('index');
            Route::get('/create', [TopicsController::class, 'create'])->name('create');
        });

        Route::prefix('/topic')->name('topic.')->group(function () {
            Route::post('/create', [TopicsController::class, 'store']);
            Route::get('/edit/{id}', [TopicsController::class, 'edit'])->name('edit');
            Route::put('/edit/{id}', [TopicsController::class, 'update']);
            Route::delete('/delete/{id}', [TopicsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('/conference/{conference_id}/schedules')->name('schedule.')->group(function () {
            Route::get('/', [SchedulesController::class, 'index'])->name('index');
            Route::get('/create', [SchedulesController::class, 'create'])->name('create');
        });

        Route::prefix('/schedule')->name('schedule.')->group(function () {
            Route::post('/create', [SchedulesController::class, 'store']);
            Route::get('/edit/{id}', [SchedulesController::class, 'edit'])->name('edit');
            Route::put('/edit/{id}', [SchedulesController::class, 'update']);
            Route::delete('/delete/{id}', [SchedulesController::class, 'destroy'])->name('delete');                
        });

        Route::prefix('/participant')->name('participant.')->group(function () {
            Route::get('/admin', [ParticipantsController::class, 'indexAdmin'])->name('admin');
            Route::get('/export', [ParticipantsController::class, 'exportParticipantsToExcel'])->name('export.excel');
        });

        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    });
});
