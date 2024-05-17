<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

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
Route::get('/map', [MapController::class, 'index']);
Route::post('/editPoint/{id}', [MapController::class, 'editPoint']);
Route::delete('/deletePoint/{id}', [MapController::class, 'deletePoint']);
Route::get('/dashboard', [MapController::class, 'dashboard']);

Route::get('/', function () {
    return view('welcome');
});
