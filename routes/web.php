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

    return view('page.about.'.$slug, [
        'navigate' => 'about',
        'slug'     => $slug,
    ]);
})->name('about');

Route::get('/event-programe/{slug?}', function ($slug = null) {
    $slug = $slug ? $slug : 'index';

    return view('page.event.'.$slug, [
        'navigate' => 'event',
        'slug'     => $slug,
    ]);
})->name('event-program');

Route::get('/resources/{slug?}', function ($slug = null) {
    $slug = $slug ? $slug : 'index-mix';

    return view('page.blog.'.$slug, [
        'navigate' => 'resources',
        'slug'     => $slug,
    ]);
});

Route::get('/results/{slug?}', function ($slug = null) {
    $slug = $slug ? $slug : 'approach';

    return view('page.results.'.$slug, [
        'navigate' => 'results',
        'slug'     => $slug,
    ]);
});

Route::get('/whymindfullness/{slug?}', function ($slug = null) {
    $slug = $slug ? $slug : 'benefits';

    return view('page.why.'.$slug, [
        'navigate' => 'whymindfullness',
        'slug'     => $slug,
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blogs', 'BlogController@index')->name('blogs');
Route::get('/blogs/{slug}', 'BlogController@show')->name('blogitem');

Route::get('/press', 'PressController@index')->name('press');
Route::get('/press/{slug}', 'PressController@show')->name('pressitem');

Route::get('/event', 'EventController@index')->name('event');
Route::get('/event/{slug}', 'EventController@show')->name('eventitem');

Route::get('/program', 'ProgramController@index')->name('program');
Route::get('/program/{slug}', 'ProgramController@show')->name('programitem');



Route::prefix('/admin')->group(function () {
    Route::get('/{any?}', 'AdminController')->where('any', '.*');
});