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

Route::middleware('api')->namespace('API')->group(function () {
    // CKFINDER ROUTER
    Route::any('ckfinder/connector/{any?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector')->where('any', '.*');

    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login');
        Route::delete('logout', 'AuthController@logout');
        Route::get('refresh', 'AuthController@refresh');
        Route::get('user', 'AuthController@user');
    });

    Route::apiResource('posts', 'PostController');
    Route::apiResource('faqs', 'FaqController');
});

Route::group(['namespace' => 'API'], function () {
    Route::apiResource('posts', 'PostController');
    Route::apiResource('users', 'UserController', ['except' => ['store']]);
    Route::apiResource('clients', 'ClientController');
});
