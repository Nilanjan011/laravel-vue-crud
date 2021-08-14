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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('add', 'App\Http\Controllers\Usercontoller@add');
Route::get('get', 'App\Http\Controllers\Usercontoller@index');
Route::get('edit/{id}', 'App\Http\Controllers\Usercontoller@edit');
Route::post('update/{id}', 'App\Http\Controllers\Usercontoller@update');
Route::delete('del/{id}', 'App\Http\Controllers\Usercontoller@delete');