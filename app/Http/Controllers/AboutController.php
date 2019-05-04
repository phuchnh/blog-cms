<?php

namespace App\Http\Controllers;

/**
 * Class AboutController
 *
 * @package App\Http\Controllers
 */
class AboutController extends Controller
{
    /**
     * @param null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index($slug = null)
    {
        $setting = (new \App\Http\View\Composers\SettingComposer)->getSettingInformation();

        if (! $slug) {
            return redirect(app()->getLocale().'/'.trans('routes.about').'/story');
        }

        // load content
        $item = isset($setting[$slug]) && $setting[$slug] ? json_decode($setting[$slug]) : null;

        // Key language
        if (isset($item->content) && $item->content) {
            $locale_key = array_search(app()->getLocale(), array_column($item->content, 'locale'));
        }

        // Set SEO information
        if (isset($item->seo) && $item->seo) {
            // Key language
            $locale_key_seo = array_search(app()->getLocale(), array_column($item->seo, 'locale'));

            \SEOMeta::setTitle($item->seo[$locale_key_seo]->title);
            \SEOMeta::setDescription($item->seo[$locale_key_seo]->description);
        }

        return view('page.about.'.$slug, [
            'navigate' => 'about',
            'item'     => isset($locale_key) && isset($item->content[$locale_key]) && $item->content[$locale_key] ? $item->content[$locale_key] : null,
            'banner'   => isset($item->banner->url) && $item->banner->url ? $item->banner->url : null,
            'slug'     => $slug,
        ]);
    }
}
