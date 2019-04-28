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


$locale = \Request::segment(1);

if (in_array($locale, ['admin', 'login'])) {
    $locale = '';
}

Route::middleware('locale')
    ->prefix($locale)->group(function(){
    Route::get(trans('routes.about').'/{slug?}', function ($slug = null) {
        if (! $slug) {
            return redirect(app()->getLocale().'/'.trans('routes.about').'/story');
        }

        return view('page.about.'.$slug, [
            'navigate' => 'about',
            'slug'     => $slug,
        ]);
    })->name('about');

    Route::get(trans('routes.event-program'), function () {
        return view('page.event.index', [
            'navigate' => 'event',
        ]);
    })->name('event-program');

    Route::get(trans('routes.resources'), function () {
        return redirect()->route(trans('routes.blog'));
    });

    Route::get(trans('routes.results').'/{slug?}', function ($slug = null) {
        if (! $slug) {
            return redirect(app()->getLocale().'/'.trans('routes.results').'/approach');
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
    })->name('results');

    Route::get(trans('routes.why-mind-fullness').'/{slug?}', function ($slug = null) {
        $slug = $slug ? $slug : 'benefits';

        return view('page.why.'.$slug, [
            'navigate' => 'whymindfullness',
            'slug'     => $slug,
        ]);
    })->name('why-mind-fullness');

    Route::get('/', 'HomeController@index')->name('home');

    Route::get(trans('routes.blog'), 'BlogController@index')->name('blog');
    Route::get(trans('routes.blog').'/{slug}', 'BlogController@show')->name('blogitem');

    Route::get(trans('routes.practice'), 'PracticeController@index')->name('practice');
    Route::get(trans('routes.practice').'/{slug}', 'PracticeController@show')->name('practiceitem');

    Route::get(trans('routes.guide'), 'GuideController@index')->name('guide');
    Route::get(trans('routes.guide').'/{slug}', 'GuideController@show')->name('guideitem');

    Route::get(trans('routes.press'), 'PressController@index')->name('press');
    Route::get(trans('routes.press').'/{slug}', 'PressController@show')->name('pressitem');

    Route::get(trans('routes.event'), 'EventController@index')->name('event');
    Route::get(trans('routes.event').'/{slug}', 'EventController@show')->name('eventitem');

    Route::get(trans('routes.program'), 'ProgramController@index')->name('program');
    Route::get(trans('routes.program').'/{slug}', 'ProgramController@show')->name('programitem');

    Route::get(trans('routes.faq'), 'FaqController@index')->name('faq');
    Route::get(trans('routes.faq').'/{slug}', 'FaqController@show')->name('faqitem');

    // change language
    Route::get('lang/{language}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);
});

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('{any?}', 'AdminController')->where('any', '.*');
});