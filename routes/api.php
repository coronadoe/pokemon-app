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

Route::get('/', "Pokemons@index");
Route::get('/show/{id}', "Pokemons@show");
Route::post('/store', "Pokemons@store");
Route::delete('/destroy/{id}', "Pokemons@destroy");
Route::post('/update/{id}', "Pokemons@update");