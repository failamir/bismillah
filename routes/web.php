<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');

Route::resource('products', App\Http\Controllers\ProductController::class);


Route::resource('categories', App\Http\Controllers\categoryController::class);


Route::resource('contohs', App\Http\Controllers\contohController::class);


Route::resource('lailas', App\Http\Controllers\LailaController::class);


Route::resource('managers', App\Http\Controllers\managerController::class);


Route::resource('apis', App\Http\Controllers\apiController::class);


Route::resource('isnacategories', App\Http\Controllers\IsnacategoryController::class);


Route::resource('pegawais', App\Http\Controllers\PegawaiController::class);


Route::resource('pembiayaans', App\Http\Controllers\PembiayaanController::class);


Route::resource('zulans', App\Http\Controllers\zulanController::class);


Route::resource('anis', App\Http\Controllers\anisController::class);


Route::resource('andris', App\Http\Controllers\andriController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('qws', App\Http\Controllers\qwController::class);
