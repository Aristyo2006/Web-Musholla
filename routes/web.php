<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Setting;
use App\Models\Article;
use App\Models\Donation;
use App\Models\Gallery;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    $articles = Article::where('is_published', true)->latest()->take(3)->get();
    $totalDonation = Donation::where('status', 'confirmed')->sum('amount');
    $featuredGalleries = Gallery::where('is_featured', true)->orderBy('order')->latest()->get();
    $settings = Setting::all()->pluck('value', 'key');
    
    return view('welcome', compact('articles', 'totalDonation', 'featuredGalleries', 'settings'));
});

Route::get('/artikel', [\App\Http\Controllers\ArticleFrontController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [\App\Http\Controllers\ArticleFrontController::class, 'show'])->name('articles.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/program-donasi', [App\Http\Controllers\CampaignFrontController::class, 'index'])->name('campaigns.index');
Route::get('/donasi/{campaign:slug}', [App\Http\Controllers\DonationFrontController::class, 'index'])->name('donasi.index');

// API Khusus Donasi Frontend Manual
Route::post('/api/donasi/{campaign}/manual', [App\Http\Controllers\DonationFrontController::class, 'uploadManual'])->name('api.donasi.manual');

Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

// Redirect admin/dashboard to just /dashboard to avoid 404
Route::get('/admin/dashboard', function() {
    return redirect()->route('dashboard');
})->middleware(['auth', 'admin']);

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('articles', ArticleController::class);
    Route::post('donations/{donation}/approve', [DonationController::class, 'approve'])->name('donations.approve');
    Route::resource('donations', DonationController::class);
    Route::resource('galleries', AdminGalleryController::class);
    Route::resource('users', UserController::class)->only(['index', 'show', 'destroy']);
    Route::patch('users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class);
    Route::get('homepage', [\App\Http\Controllers\Admin\HomepageController::class, 'index'])->name('homepage.index');
    Route::post('homepage', [\App\Http\Controllers\Admin\HomepageController::class, 'update'])->name('homepage.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
