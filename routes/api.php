<?php

use Illuminate\Http\Request;

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

Route::post('/book/add', 'BookController@add');

Route::get('/book/all', 'BookController@all');

Route::delete('/book/delete/{id}', 'BookController@delete');

Route::get('/book/change_availability/{id}', 'BookController@changeAvailabilty');

Route::get('/book/search_by_id/{value}', 'BookController@search_by_id');

Route::get('/book/search_by_title/{value}', 'BookController@search_by_title');

Route::get('/book/search_by_author/{value}', 'BookController@search_by_author');