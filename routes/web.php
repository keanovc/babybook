<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Scraper;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Babylist;
use App\Http\Controllers\Cart;
use App\Http\Controllers\Checkout;
use App\Http\Controllers\Webhook;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', Babylist\BabylistController::class)->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/copy', [Babylist\BabylistController::class, 'copy'])->middleware(['auth'])->name('dashboard.copy');
Route::get('/addlist', [Babylist\BabylistController::class, 'addlist'])->middleware(['auth'])->name('addlist');
Route::post('/addlist/store', [Babylist\BabylistController::class, 'storeList'])->middleware(['auth'])->name('addlist.store');
Route::get('/items/{list}', [Babylist\BabylistController::class, 'items'])->middleware(['auth'])->name('items');
Route::delete('/items/{list}', [Babylist\BabylistController::class, 'removeItems'])->middleware(['auth'])->name('items.delete');
Route::get('/items/{list}/additems', [Babylist\BabylistController::class, 'additems'])->middleware(['auth'])->name('additems');
Route::post('/items/{list}/additems/store', [Babylist\BabylistController::class, 'storeItems'])->middleware(['auth'])->name('additems.store');

Route::get('/items/{list}/orders', [Babylist\BabylistController::class, 'orders'])->middleware(['auth'])->name('orders');
Route::get('/items/{list}/orders/{order}', [Babylist\BabylistController::class, 'reserved'])->middleware(['auth'])->name('orders.reserved');

Route::get('/invitation', [Cart\CartController::class, 'invitation'])->name('invitation');
Route::get('/invitation/list', [Cart\CartController::class, 'guestlist'])->name('guestlist');
Route::post('/invitation/list/item', [Cart\CartController::class, 'cartitem'])->name('cartitem');
Route::get('/invitation/list/cart', [Cart\CartController::class, 'cart'])->name('cart');
Route::delete('/invitation/list/cart/{item}', [Cart\CartController::class, 'deleteitem'])->name('cart.delete');

Route::get('/checkout', [Checkout\CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [Checkout\CheckoutController::class, 'success'])->name('checkout.success');

Route::post('/webhooks/mollie', [Webhook\WebhookController::class, 'handleWebhookNotification'])->name('webhooks.mollie');

Route::get('/adminDashboard', [Auth\AdminController::class, 'show'])->middleware(['auth', 'admin'])->name('adminDashboard');
Route::get('/scraper', [Scraper\ScraperController::class, 'show'])->middleware(['auth', 'admin'])->name('scraper.show');
Route::post('/scraper/scrape/categories', [Scraper\ScraperController::class, 'scrapeCategories'])->middleware(['auth', 'admin'])->name('scraper.categories');
Route::post('/scraper/scrape/articles', [Scraper\ScraperController::class, 'scrapeArticles'])->middleware(['auth', 'admin'])->name('scraper.articles');

require __DIR__.'/auth.php';
