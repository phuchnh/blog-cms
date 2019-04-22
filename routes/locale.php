<?php

/*
|--------------------------------------------------------------------------
| Locale Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "locale" middleware group. Now create something great!
|
*/

Route::get('/about/{slug?}', function ($slug = null) {
    if (! $slug) {
        return redirect('/about/story');
    }

    return view('page.about.'.$slug, [
        'navigate' => 'about',
        'slug'     => $slug,
    ]);
})->name('about');

Route::get('/event-programe', function () {
    return view('page.event.index', [
        'navigate' => 'event',
    ]);
})->name('event-program');

Route::get('/resources', function () {
    return redirect()->route('blog');
});

Route::get('/results/{slug?}', function ($slug = null) {
    if (! $slug) {
        return redirect('/results/approach');
    }

    if ($slug === 'testimonial') {
        $data = \App\Models\Client::get();

        $controller = new \App\Http\Controllers\Controller();

        $clients = $controller->loadTransformData($data, \App\Transformers\ClientTransformer::class);
    }

    return view('page.results.'.$slug, [
        'clients'  => isset($clients) && $clients ? $clients : null,
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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/'.trans('routes.blogs'), 'BlogController@index')->name('blog');
Route::get('/'.trans('routes.blogs').'/{slug}', 'BlogController@show')->name('blogitem');

Route::get('/'.trans('routes.practice'), 'PracticeController@index')->name('practice');
Route::get('/'.trans('routes.practice').'/{slug}', 'PracticeController@show')->name('practiceitem');

Route::get('/'.trans('routes.guide'), 'GuideController@index')->name('guide');
Route::get('/'.trans('routes.guide').'/{slug}', 'GuideController@show')->name('guideitem');

Route::get('/'.trans('routes.press'), 'PressController@index')->name('press');
Route::get('/'.trans('routes.press').'/{slug}', 'PressController@show')->name('pressitem');

Route::get('/'.trans('routes.event'), 'EventController@index')->name('event');
Route::get('/'.trans('routes.event').'/{slug}', 'EventController@show')->name('eventitem');

Route::get('/'.trans('routes.program'), 'ProgramController@index')->name('program');
Route::get('/'.trans('routes.program').'/{slug}', 'ProgramController@show')->name('programitem');

Route::get('/'.trans('routes.faq'), 'FaqController@index')->name('faq');
Route::get('/'.trans('routes.faq').'/{slug}', 'FaqController@show')->name('faqitem');

// change language
Route::get('lang/{language}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);