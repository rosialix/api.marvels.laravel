<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuzzleController;
use App\Http\Controllers\FavoritoController;

Route::get('/', [GuzzleController::class, 'index'])->middleware('auth');
Route::get('home', [GuzzleController::class, 'store'])->name('home')->middleware('auth');
Route::get('detail/{id}', [GuzzleController::class, 'show'])->name('detail');
Route::get('comics/{comic_id}/{comic_title}', [GuzzleController::class, 'guardar'])->name('comics');
Route::get('comics/{comic_id}', [GuzzleController::class, 'eliminar'])->name('comics');


Auth::routes();

Route::resource('favoritos', App\Http\Controllers\FavoritoController::class)->middleware('auth');


// Route::get('/store-data', [PostController::class, 'store']);

