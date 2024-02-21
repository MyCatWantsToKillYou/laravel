<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksControler;

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
Route::get('/links', [LinksControler::class, 'show'])->name('links.show');
Route::get('/links', [LinksControler::class, 'send'])->name('links.send');
Route::get('/links/{prefix}', [LinksControler::class, 'away'])->where('prefix', '\w+')->name('links.away');
