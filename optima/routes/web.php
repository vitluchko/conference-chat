<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ConferencesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\TopicsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');


Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');

Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');


Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'store'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');


Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->middleware('guest')->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('guest')->name('password.email');


Route::get('/reset-password', [ResetPasswordController::class, 'create'])->middleware('guest')->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])->middleware('guest')->name('password.update');


Route::get('/dashboard', [PostsController::class, 'index'])->middleware('auth')->name('dashboard');


Route::get('/post/create', [PostsController::class, 'create'])->middleware('auth')->name('post.create');

Route::post('/post/create', [PostsController::class, 'store'])->middleware('auth');

Route::get('/post/{id}-{slug}', [PostsController::class, 'show'])->middleware('auth')->name('post.show');

Route::get('/post/edit/{id}-{slug}', [PostsController::class, 'edit'])->middleware('auth')->name('post.edit');

Route::put('/post/edit/{id}', [PostsController::class, 'update'])->middleware('auth');

Route::delete('/post/delete/{id}', [PostsController::class, 'destroy'])->middleware('auth')->name('post.delete');


Route::get('/conference', [ConferencesController::class, 'index'])->middleware('auth')->name('conference');

Route::get('/conference/admin', [ConferencesController::class, 'indexAdmin'])->middleware('auth')->name('conference.admin');

Route::get('/conference/create', [ConferencesController::class, 'create'])->middleware('auth')->name('conference.create');

Route::post('/conference/create', [ConferencesController::class, 'store'])->middleware('auth');

Route::get('/conference/edit/{id}', [ConferencesController::class, 'edit'])->middleware('auth')->name('conference.edit');

Route::put('/conference/edit/{id}', [ConferencesController::class, 'update'])->middleware('auth');

Route::delete('/conference/delete/{id}', [ConferencesController::class, 'destroy'])->middleware('auth')->name('conference.delete');

Route::post('/conference/set-active', [ConferencesController::class, 'setActiveById'])->name('conference.setActiveById');

Route::post('/conference/set-in-active', [ConferencesController::class, 'setInactiveById'])->name('conference.setInactiveById');


Route::get('/topic/{id}', [TopicsController::class, 'index'])->middleware('auth')->name('topic');

Route::get('/topic/{id}/create', [TopicsController::class, 'create'])->middleware('auth')->name('topic.create');

Route::post('/topic/create', [TopicsController::class, 'store'])->middleware('auth');

Route::get('/topic/edit/{id}', [TopicsController::class, 'edit'])->middleware('auth')->name('topic.edit');

Route::put('/topic/edit/{id}', [TopicsController::class, 'update'])->middleware('auth');

Route::delete('/topic/delete/{id}', [TopicsController::class, 'destroy'])->middleware('auth')->name('topic.delete');


Route::get('/schedule/{id}', [SchedulesController::class, 'index'])->middleware('auth')->name('schedule');

Route::get('/schedule/{id}/create', [SchedulesController::class, 'create'])->middleware('auth')->name('schedule.create');

Route::post('/schedule/create', [SchedulesController::class, 'store'])->middleware('auth');

Route::get('/schedule/edit/{id}', [SchedulesController::class, 'edit'])->middleware('auth')->name('schedule.edit');

Route::put('/schedule/edit/{id}', [SchedulesController::class, 'update'])->middleware('auth');

Route::delete('/schedule/delete/{id}', [SchedulesController::class, 'destroy'])->middleware('auth')->name('schedule.delete');
