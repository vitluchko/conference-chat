<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ConferencesController;
use App\Http\Controllers\PostsController;
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
