<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
<<<<<<< HEAD


Route::resource('plans', App\Http\Controllers\API\PlanAPIController::class);
=======
<<<<<<< Updated upstream
=======


Route::resource('plans', App\Http\Controllers\API\PlanAPIController::class);


Route::resource('contohs', App\Http\Controllers\API\ContohAPIController::class);
>>>>>>> Stashed changes
>>>>>>> fix
