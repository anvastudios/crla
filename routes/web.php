<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

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
    return view('startpage');
});

Auth::routes();

Route::get('/bo-setStatusProcessed/{ticket}', [App\Http\Controllers\TicketController::class, 'setStatusProcessed']);
Route::get('/bo-show/{ticket}', [App\Http\Controllers\TicketController::class, 'show']);
Route::get('/kontakt', [App\Http\Controllers\TicketController::class, 'create']);

Route::resource('kontaktanfrage', TicketController::class);

