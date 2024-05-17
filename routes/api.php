<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\PlacesofInterestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);
Route::put('/user/{id}', [UserAuthController::class, 'updateadmin']);
Route::get('places_of_interests/{id}', [PlacesofInterestController::class, 'showPoint']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/getUserPoints', [PlacesofInterestController::class, 'getUserPoints']);
    Route::post('/crearPunto', [PlacesofInterestController::class, 'createPoint']);
    Route::delete('/places_of_interests/{id}', [PlacesofInterestController::class, 'deletePoint']);
    Route::put('/places_of_interests/{id}', [PlacesofInterestController::class, 'updatePoint']);

});