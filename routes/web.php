<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/news', function() {
    return view('news');
});

Route::get('/about-me', function() {
    return view('about-me');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/view-profile', [HomeController::class, 'view_profile'])->name('view-profile');

Route::controller(CategoryController::class)->group(function(){
    Route::get('/categories', 'index')->name('categories.index');
    Route::post('/categories', 'store')->name('categories.store');
    Route::get('/categories/{id}', 'show')->name('categories.show');
    Route::put('/categories/{id}', 'update')->name('categories.update');
    Route::delete('/categories/{id}', 'destroy')->name('categories.destroy');
});

Route::controller(TagController::class)->group(function(){
    Route::get('/tags', 'index')->name('tags.index');
    Route::post('/tags', 'store')->name('tags.store');
    Route::get('/tags/{id}', 'show')->name('tags.show');
    Route::put('/tags/{id}', 'update')->name('tags.update');
    Route::delete('/tags/{id}', 'destroy')->name('tags.destroy');
});

Route::controller(ArticleController::class)->group(function(){
    Route::get('/articles', 'index')->name('articles.index');
    Route::post('/articles', 'store')->name('articles.store');
    Route::get('/articles/{id}', 'show')->name('articles.show');
    Route::put('/articles/{id}', 'update')->name('articles.update');
    Route::delete('/articles/{id}', 'destroy')->name('articles.destroy');
    Route::get('/articles/{id}/view', 'view_article')->name('articles.view');
});
