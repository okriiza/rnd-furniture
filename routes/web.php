<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/product', [ProductController::class, 'index'])
        ->name('product.index');
});


Route::controller(LandingController::class)->group(function () {
    Route::get('/', 'index')
        ->name('home');
    Route::get('/blog', 'blog')
        ->name('blog');
    Route::get('/contact', 'contact')
        ->name('contact');
    Route::get('/about', 'about')
        ->name('about');
    Route::get('/service', 'service')
        ->name('service');
    Route::get('/shop', 'shop')
        ->name('shop');
    Route::get('cart', 'cart')
        ->name('cart');
    Route::get('checkout', 'checkout')
        ->name('checkout');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
