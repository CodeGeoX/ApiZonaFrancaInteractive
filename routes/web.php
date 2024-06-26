<?php

use App\Http\Controllers\ProfileController;
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
Route::get('/info', [MapController::class, 'info'])->name('info');

Route::get('/map', [MapController::class, 'index'])->name('map');
Route::post('/editPoint/{id}', [MapController::class, 'editPoint']);
Route::delete('/deletePoint/{id}', [MapController::class, 'deletePoint']);
Route::get('/dashboard', [MapController::class, 'dashboard']);
Route::post('/addPoint', [MapController::class, 'addPoint'])->name('addPoint');
Route::get('/zonafranca', function () {
    return view('dashboard');
})->name('zonafranca.show');

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
