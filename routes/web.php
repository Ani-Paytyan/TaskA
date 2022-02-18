<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
//|
//*/
//Route::get('/', function () {
//    return view('index');
//});

Route::get('/', [\App\Http\Controllers\UserController::class, 'index']);

Route::get('index', [\App\Http\Controllers\UserController::class, 'index']);
Route::get('create', function(){
    return view('create');
});
Route::post('createUser', [\App\Http\Controllers\UserController::class, 'store']);
Route::put('updateUser/{id}', [\App\Http\Controllers\UserController::class, 'update']);
Route::get('edit/{id}', [\App\Http\Controllers\UserController::class, 'edit']);
Route::post('remove', [\App\Http\Controllers\UserController::class, 'destroy']);
//Route::get('remove/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);


//
//
//
