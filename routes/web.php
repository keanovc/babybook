<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Scraper;
use App\Http\Controllers\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/adminDashboard', [Auth\AdminController::class, 'show'])->middleware(['auth'])->name('adminDashboard');

Route::get('/scraper', [Scraper\ScraperController::class, 'show'])->middleware(['auth'])->name('scraper.show');
Route::post('/scraper/scrape/categories', [Scraper\ScraperController::class, 'scrapeCategories'])->middleware(['auth'])->name('scraper.categories');
Route::post('/scraper/scrape/articles', [Scraper\ScraperController::class, 'scrapeArticles'])->middleware(['auth'])->name('scraper.articles');

require __DIR__.'/auth.php';
