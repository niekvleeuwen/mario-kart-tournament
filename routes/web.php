<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/* Tournaments */
Route::get('/tournaments', [App\Http\Controllers\TournamentsController::class, 'index'])->name('tournaments.index');
Route::get('/tournaments/create', [App\Http\Controllers\TournamentsController::class, 'create'])->name('tournaments.create');
Route::get('/tournaments/{tournament}', [App\Http\Controllers\TournamentsController::class, 'show'])->name('tournaments.show');
Route::get('/tournaments/{tournament}/edit', [App\Http\Controllers\TournamentsController::class, 'edit'])->name('tournaments.edit');
Route::post('/tournaments', [App\Http\Controllers\TournamentsController::class, 'store'])->name('tournaments.store');
Route::patch('/tournaments/{tournament}', [App\Http\Controllers\TournamentsController::class, 'update'])->name('tournaments.update');
Route::delete('/tournaments/{tournament}', [App\Http\Controllers\TournamentsController::class, 'delete'])->name('tournaments.delete');


