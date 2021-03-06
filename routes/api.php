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

Route::resource('plans', App\Http\Controllers\API\PlanAPIController::class);

Route::resource('plans', App\Http\Controllers\API\PlanAPIController::class);

Route::resource('contohs', App\Http\Controllers\API\ContohAPIController::class);


Route::resource('beritas', App\Http\Controllers\API\BeritaAPIController::class);


Route::resource('news', App\Http\Controllers\API\NewsAPIController::class);
