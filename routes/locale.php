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

$setting = (new \App\Http\View\Composers\SettingComposer)->getSettingInformation();

Route::get(trans('routes.about').'/{slug?}', function ($slug = null) use ($setting) {

    // Set SEO information
    if (isset($setting['about_seo'][app()->getLocale()]->title) && $setting['about_seo'][app()->getLocale()]->description) {
        SEOMeta::setTitle($setting['about_seo'][app()->getLocale()]->title);
        SEOMeta::setDescription($setting['about_seo'][app()->getLocale()]->description);
    }

    if (! $slug) {
        return redirect(app()->getLocale().'/'.trans('routes.about').'/story');
    }

    return view('page.about.'.$slug, [
        'navigate' => 'about',
        'slug'     => $slug,
    ]);
})->name('about');

Route::get(trans('routes.event-program'), function () use ($setting) {
    // Set SEO information
    if (isset($setting['event_seo'][app()->getLocale()]->title) && $setting['event_seo'][app()->getLocale()]->description) {
        SEOMeta::setTitle($setting['event_seo'][app()->getLocale()]->title);
        SEOMeta::setDescription($setting['event_seo'][app()->getLocale()]->description);
    }

    return view('page.event.index', [
        'navigate' => 'event',
    ]);
})->name('event-program');

Route::get(trans('routes.resources'), function () use ($setting) {
    // Set SEO information
    if (isset($setting['resource_seo'][app()->getLocale()]->title) && $setting['resource_seo'][app()->getLocale()]->description) {
        SEOMeta::setTitle($setting['resource_seo'][app()->getLocale()]->title);
        SEOMeta::setDescription($setting['resource_seo'][app()->getLocale()]->description);
    }

    return redirect()->route(trans('routes.blog'));
})->name('resources');

Route::get(trans('routes.results').'/{slug?}', function ($slug = null) use ($setting) {
    // Set SEO information
    if (isset($setting['results_seo'][app()->getLocale()]->title) && $setting['results_seo'][app()->getLocale()]->description) {
        SEOMeta::setTitle($setting['results_seo'][app()->getLocale()]->title);
        SEOMeta::setDescription($setting['results_seo'][app()->getLocale()]->description);
    }

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

Route::get(trans('routes.why-mind-fullness').'/{slug?}', function ($slug = null) use ($setting) {
    // Set SEO information
    if (isset($setting['why_seo'][app()->getLocale()]->title) && $setting['why_seo'][app()->getLocale()]->description) {
        SEOMeta::setTitle($setting['why_seo'][app()->getLocale()]->title);
        SEOMeta::setDescription($setting['why_seo'][app()->getLocale()]->description);
    }

    $slug = $slug ? $slug : 'benefits';

    return view('page.why.'.$slug, [
        'navigate' => 'whymindfullness',
        'slug'     => $slug,
    ]);
})->name('why-mind-fullness');

Route::get('/', 'HomeController@index')->name('home');
Route::get(trans('routes.home'), 'HomeController@index')->name('homepage');

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