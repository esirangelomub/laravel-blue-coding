<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::name('auth.')
        ->prefix('auth')
        ->group(function () {
            Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
                Route::post('/register', 'register')->name('register');
                Route::post('/token', 'token')->name('token');
                Route::get('/email', 'email')->name('email')->middleware(['auth:sanctum']);
            });
        });

    Route::name('posts.')
        ->prefix('posts')
        ->group(function () {
            Route::controller(\App\Http\Controllers\PostController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/{post}', 'show')->name('show');
                Route::put('/{post}', 'update')->name('update');
                Route::delete('/{post}', 'destroy')->name('destroy');

                Route::controller(\App\Http\Controllers\TagController::class)->group(function () {
                    Route::get('/{post}/tags', 'index')->name('tags.index');
                    Route::post('/{post}/tags', 'store')->name('tags.store');
                    Route::get('/{post}/tags/{tag}', 'show')->name('tags.show');
                    Route::put('/{post}/tags/{tag}', 'update')->name('tags.update');
                    Route::delete('/{post}/tags/{tag}', 'destroy')->name('tags.destroy');
                });
            });
        });

    Route::name('crawler.')
        ->prefix('crawler')
        ->group(function () {
            Route::controller(\App\Http\Controllers\CrawlerController::class)->group(function () {
                Route::post('/search', 'search')->name('search')->middleware(['auth:sanctum']);
            });
        });

    Route::name('shorten.')
        ->prefix('shorten')
        ->group(function () {
            Route::controller(\App\Http\Controllers\ShortLinkController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
            });
        });
});
