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

Route::get('/about/{slug?}', function ($slug = null) {
    if (!$slug){
        return redirect('/about/story');
    }

    return view('page.about.'.$slug, [
        'navigate' => 'about',
        'slug'     => $slug,
    ]);
})->name('about');

Route::get('/event-programe', function () {
    return view('page.event.index', [
        'navigate' => 'event'
    ]);
})->name('event-program');

Route::get('/resources', function () {
    return redirect()->route('blog');
});

Route::get('/results/{slug?}', function ($slug = null) {
    if (!$slug){
        return redirect('/results/approach');
    }

    if ($slug === 'testimonial') {
        $data = \App\Models\Client::get();

        $controller = new \App\Http\Controllers\Controller();

        $clients = $controller->loadTransformData($data,  \App\Transformers\ClientTransformer::class);
    }



    return view('page.results.'.$slug, [
        'clients' => isset($clients) && $clients ? $clients : null,
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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/blogs', 'BlogController@index')->name('blog');
Route::get('/blogs/{slug}', 'BlogController@show')->name('blogitem');

Route::get('/practice', 'PracticeController@index')->name('practice');
Route::get('/practice/{slug}', 'PracticeController@show')->name('practiceitem');

Route::get('/guide', 'GuideController@index')->name('guide');
Route::get('/guide/{slug}', 'GuideController@show')->name('guideitem');

Route::get('/press', 'PressController@index')->name('press');
Route::get('/press/{slug}', 'PressController@show')->name('pressitem');

Route::get('/event', 'EventController@index')->name('event');
Route::get('/event/{slug}', 'EventController@show')->name('eventitem');

Route::get('/program', 'ProgramController@index')->name('program');
Route::get('/program/{slug}', 'ProgramController@show')->name('programitem');

Route::get('/faq', 'FaqController@index')->name('faq');
Route::get('/faq/{slug}', 'FaqController@show')->name('faqitem');

// change language
Route::get('lang/{language}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::prefix('/admin')->group(function () {
    Route::get('/{any?}', 'AdminController')->where('any', '.*');
});