<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\JobsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', [PagesController::class, 'about'])->name('about');
Route::get('/services', [PagesController::class, 'services'])->name('services');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.loginSubmit');

// Admin Authentication Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Change resource routes to use index as the base route
    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::resource('hero', HeroController::class)->except(['index']);
    
    Route::get('/ads', [AdsController::class, 'index'])->name('ads.index');
    Route::resource('ads', AdsController::class)->except(['index']);
    
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::resource('news', NewsController::class)->except(['index']);
    
    Route::get('/jobs', [JobsController::class, 'index'])->name('jobs.index');
    Route::resource('jobs', JobsController::class)->except(['index']);
});

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');