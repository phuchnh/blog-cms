<?php
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

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::delete('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user', 'AuthController@user');
});
Route::group(['namespace' => 'API'], function () {
    Route::apiResource('posts', 'PostController');
    Route::apiResource('users', 'UserController', ['except' => ['store']]);
    Route::apiResource('clients', 'ClientController');
});
