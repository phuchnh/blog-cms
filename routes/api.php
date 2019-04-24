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
    Route::match(['put', 'patch'], 'post/taxonomies/{post}', 'TaxonomyController@updateTaxonomies');
    Route::apiResource('faqs', 'FaqController');
    Route::apiResource('users', 'UserController', ['except' => ['store']]);
    Route::apiResource('clients', 'ClientController');
    Route::apiResource('options', 'OptionController');

    Route::apiResource('posts.metas', 'PostMetaController')->parameters([
        'metas' => 'metum',
    ]);
    Route::apiResource('taxonomies.metas', 'TaxonomyMetaController')->parameters([
        'metas' => 'metum',
    ]);
    Route::apiResource('clients.metas', 'ClientMetaController')->parameters([
        'metas' => 'metum',
    ]);

    Route::match(['put', 'post'], 'assets', 'AssetController@upload');
    Route::get('assets', 'AssetController@index');
});
