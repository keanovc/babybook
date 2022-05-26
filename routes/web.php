<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Scraper;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Babylist;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', Babylist\BabylistController::class)->middleware(['auth'])->name('dashboard');
Route::get('/addlist', [Babylist\BabylistController::class, 'addlist'])->middleware(['auth'])->name('addlist');
Route::post('/addlist/store', [Babylist\BabylistController::class, 'storeList'])->middleware(['auth'])->name('addlist.store');
Route::get('/items/{list}', [Babylist\BabylistController::class, 'items'])->middleware(['auth'])->name('items');
Route::get('/items/{list}/additems', [Babylist\BabylistController::class, 'additems'])->middleware(['auth'])->name('additems');
Route::post('/items/{list}/additems/store', [Babylist\BabylistController::class, 'storeItems'])->middleware(['auth'])->name('additems.store');

Route::get('/reserved', [Babylist\BabylistController::class, 'reserved'])->middleware(['auth'])->name('reserved');

Route::get('/invitation', function () {
    return view('invitation');
});
Route::post('/invitation', [Babylist\BabylistController::class, 'guestlist'])->name('guestlist');

Route::get('/adminDashboard', [Auth\AdminController::class, 'show'])->middleware(['auth'])->name('adminDashboard');
Route::get('/scraper', [Scraper\ScraperController::class, 'show'])->middleware(['auth'])->name('scraper.show');
Route::post('/scraper/scrape/categories', [Scraper\ScraperController::class, 'scrapeCategories'])->middleware(['auth'])->name('scraper.categories');
Route::post('/scraper/scrape/articles', [Scraper\ScraperController::class, 'scrapeArticles'])->middleware(['auth'])->name('scraper.articles');

require __DIR__.'/auth.php';
