<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
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
Route::resource('record', App\Http\Controllers\RecordController::class);
// Route::resource('create', App\Http\Controllers\RecordController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/record', [App\Http\Controllers\RecordController::class, 'index'])->name('record');
//Route::POST('record', [App\Http\Controllers\RecordController::class, 'AddRecord']);
//Route::POST('record', [App\Http\Controllers\RecordController::class, 'create']);
//Route::POST('create', [App\Http\Controllers\RecordController::class, 'AddRecord']);
// Route::post('/create', 'RecordController@AddRecord')->name('create');
Route::get('home', [App\Http\Controllers\RecordController::class, 'show']);
// Route::get('home', [App\Http\Controllers\RecordExportController::class, 'export']);
// Route::get('home', [App\Http\Controllers\RecordController::class, 'exporttocsv']);

