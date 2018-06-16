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

Route::delete('/document', 'DocumentsController@destroy');

Route::get('/loans/paginate', 'LoansController@paginate');

Route::post('/loans/liked', 'LoansController@liked');
Route::post('/loans/unliked', 'LoansController@unliked');
