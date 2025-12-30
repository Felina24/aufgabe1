<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\CustomRegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| 商品関連（ProductController）
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/item/{item}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/sell', [ProductController::class, 'create'])
    ->middleware('auth')
    ->name('products.create');

Route::post('/sell', [ProductController::class, 'store'])
    ->middleware('auth')
    ->name('products.store');

Route::get('/mylist', [ProductController::class, 'mylist'])
    ->middleware('auth')
    ->name('products.mylist');

Route::post('/products/{item}/like', [ProductController::class, 'toggleLike'])
    ->middleware('auth')
    ->name('products.like');

Route::post('/products/{item}/comment', [CommentsController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Route::get('/search', [SearchController::class, 'index'])
    ->name('products.search');

/*
|--------------------------------------------------------------------------
| 購入関連（PurchaseController）
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

Route::get('/purchase/{id}', [PurchaseController::class, 'show'])
    ->name('purchase.show');

Route::post('/purchase/{id}', [PurchaseController::class, 'store'])
    ->name('purchase.store');

/*
|--------------------------------------------------------------------------
| 住所関連（AddressController）
|--------------------------------------------------------------------------
*/
Route::get('/purchase/address/{item_id}', [AddressController::class, 'edit'])
    ->middleware('auth')
    ->name('address.edit');

Route::post('/purchase/address/{item_id}', [AddressController::class, 'update'])
    ->middleware('auth')
    ->name('address.update');

/*
|--------------------------------------------------------------------------
| プロフィール関連（ProfileController）
|--------------------------------------------------------------------------
*/
Route::get('/mypage', [ProfileController::class, 'mypage'])
    ->middleware('auth')
    ->name('mypage');

Route::get('/mypage/bought', [ProfileController::class, 'bought'])
    ->middleware('auth')
    ->name('mypage.bought');

Route::get('/mypage/profile', [ProfileController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('profile.edit');

Route::post('/mypage/profile', [ProfileController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('profile.update');

Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('profile.show');

});

/*
|--------------------------------------------------------------------------
| 認証関連
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');