<?php

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
    return view('page.home', [
        'navigate' => 'home',
    ]);
});

Route::get('/about/{slug?}', function ($slug = null) {
    $slug = $slug ? $slug : 'story';

    return view('page.about.' . $slug, [
        'navigate' => 'about',
        'slug'     => $slug,
    ]);
});

Route::get('/event/{slug?}', function ($slug = null) {
    $slug = $slug ? $slug : 'index';

    return view('page.event.' . $slug, [
        'navigate' => 'event',
        'slug'     => $slug,
    ]);
});

Route::get('/resources/{slug?}', function ($slug = null) {
    $slug = $slug ? $slug : 'index-mix';

    return view('page.blog.' . $slug, [
        'navigate' => 'resources',
        'slug'     => $slug,
    ]);
});

Route::get('/results/{slug?}', function ($slug = null) {
    $slug = $slug ? $slug : 'approach';

    return view('page.results.' . $slug, [
        'navigate' => 'results',
        'slug'     => $slug,
    ]);
});

Route::get('/whymindfullness/{slug?}', function ($slug = null) {
    $slug = $slug ? $slug : 'benefits';

    return view('page.why.' . $slug, [
        'navigate' => 'whymindfullness',
        'slug'     => $slug,
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->group(function () {
    Route::get('/{any?}', 'AdminController')->where('any', '.*');
});