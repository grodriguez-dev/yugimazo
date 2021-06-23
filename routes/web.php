<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\MazoController;
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
Route::redirect('/home', '/courses');

Route::resource('players', PlayerController::class);
Route::resource('cards', CardController::class);
Route::resource('mazos', MazoController::class);

Route::post('/ver_cards', [MazoController::class, 'verCard'])->name('ver_cards.verCard');
Route::post('/saved_cards', [MazoController::class, 'savedCard'])->name('saved_cards.savedCard');
Route::get('/mazos_card/{id}', [MazoController::class, 'card'])->name('mazos_card.card');
