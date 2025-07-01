<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NewsControllers;
use App\Http\Controllers\JobController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\JobsController;

use App\Http\Controllers\ContactController;

// models
use App\Models\Hero;
use App\Models\Ad;
use App\Models\Job;

Route::get('/run-admin-seeder', function () {
    Artisan::call('db:seed', [
        '--class' => 'AdminUserSeeder',
    ]);

    return "AdminUserSeeder has been run.";
});

Route::get('/create-symlink', function () {
    $target = '/home/wrsnepal/laravel/storage/app/public';
    $link = '/home/wrsnepal/public_html/storage';

    // Check if symlink already exists
    if (!File::exists($link)) {
        // Create the symbolic link
        if (symlink($target, $link)) {
            return 'Symlink created successfully!';
        } else {
            return 'Failed to create symlink.';
        }
    } else {
        return 'Symlink already exists.';
    }
});

Route::get('/', function () {
    $hero = Hero::getActive();
    $ad = Ad::getActive();
    return view('welcome', compact('hero', 'ad'));
})->name('home');  // Add the route name here

Route::get('/about-us', [PagesController::class, 'about'])->name('about');
Route::get('/services', [PagesController::class, 'services'])->name('services');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.loginSubmit');

// Admin Authentication Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::get('/hero/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');
    
    Route::get('/ads', [AdsController::class, 'index'])->name('ads.index');
    Route::get('/ads/edit', [AdsController::class, 'edit'])->name('ads.edit');
    Route::put('/ads', [AdsController::class, 'update'])->name('ads.update');
    
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::resource('news', NewsController::class)->except(['index']);
    Route::post('/news/upload', [NewsController::class, 'uploadImage'])->name('news.upload');

    Route::get('/jobs', [JobsController::class, 'index'])->name('jobs.index');
    Route::resource('jobs', JobsController::class)->except(['index']);
});

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

// Public news routes
Route::get('/news', [NewsControllers::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsControllers::class, 'show'])->name('news.read');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');