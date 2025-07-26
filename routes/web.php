<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
/*
Route::get('/', function () {
    return view('welcome');
});
*/

/*
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
*/

Route::get('/home', [ArticleController::class, 'index'])->name('home');
Route::get('/', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/{url}', [ArticleController::class, 'show'])->name('articles.show')
    ->where('url', '[\w\d\-]+');

    use App\Http\Controllers\OccupationSalleController;

Route::get('/calendar', [OccupationSalleController::class, 'index']);
Route::get('/events', [OccupationSalleController::class, 'fetchEvents']);
Route::post('/events', [OccupationSalleController::class, 'store']);
