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


Route::resource('products', App\Http\Controllers\API\ProductAPIController::class);


Route::resource('categories', App\Http\Controllers\API\categoryAPIController::class);


Route::resource('contohs', App\Http\Controllers\API\contohAPIController::class);


Route::resource('lailas', App\Http\Controllers\API\LailaAPIController::class);


Route::resource('managers', App\Http\Controllers\API\managerAPIController::class);


Route::resource('apis', App\Http\Controllers\API\apiAPIController::class);


Route::resource('isnacategories', App\Http\Controllers\API\IsnacategoryAPIController::class);


Route::resource('pegawais', App\Http\Controllers\API\PegawaiAPIController::class);


Route::resource('pembiayaans', App\Http\Controllers\API\PembiayaanAPIController::class);


Route::resource('zulans', App\Http\Controllers\API\zulanAPIController::class);


Route::resource('anis', App\Http\Controllers\API\anisAPIController::class);


Route::resource('andris', App\Http\Controllers\API\andriAPIController::class);


Route::resource('qws', App\Http\Controllers\API\qwAPIController::class);


Route::resource('safitris', App\Http\Controllers\API\SafitriAPIController::class);
