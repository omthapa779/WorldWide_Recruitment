<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', [PagesController::class, 'about'])->name('about');
Route::get('/services', [PagesController::class, 'services'])->name('services');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');