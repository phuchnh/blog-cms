<?php

namespace App\Http\Controllers;

/**
 * Class EventProgramController
 *
 * @package App\Http\Controllers
 */
class EventProgramController extends Controller
{
    public function index($slug = null)
    {
        $setting = (new \App\Http\View\Composers\SettingComposer)->getSettingInformation();

        // load content
        $item = isset($setting['eventprogram']) && $setting['eventprogram'] ? json_decode($setting['eventprogram']) : null;

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

        return view('page.event.index', [
            'item'     => isset($locale_key) && isset($item->content[$locale_key]) && $item->content[$locale_key] ? $item->content[$locale_key] : null,
            'banner'   => isset($item->banner->url) && $item->banner->url ? $item->banner->url : null,
            'navigate' => 'event-program',
            'slug' => 'event-program'
        ]);
    }
}
