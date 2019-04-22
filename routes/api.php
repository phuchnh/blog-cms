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

Route::middleware('auth:api')->namespace('API')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login');
        Route::delete('logout', 'AuthController@logout');
        Route::get('refresh', 'AuthController@refresh');
        Route::get('user', 'AuthController@user');
    });

    Route::apiResource('posts', 'PostController');
    Route::put('posts/{post}/restore', 'PostController@restore');
    Route::delete('posts/{post}/permanent', 'PostController@deletePermanently');

    Route::apiResource('taxonomies', 'TaxonomyController');
    Route::apiResource('faqs', 'FaqController');
    Route::apiResource('users', 'UserController', ['except' => ['store']]);
    Route::apiResource('clients', 'ClientController');
    Route::apiResource('options', 'OptionController');

    Route::prefix('{model}/{modelId}')->group(function () {
        Route::apiResource('meta', 'MetaController');
        Route::match(['put', 'patch'], 'meta', 'MetaController@updateMany');
    });

    Route::match(['put', 'patch'], '/meta/{post}/post_meta', 'PostMetaController@updateMany');

    Route::apiResource('posts.post_meta', 'PostMetaController')->parameters([
        'meta' => 'post_meta'
    ]);
    
    Route::post('assets','AssetController@upload');
});
