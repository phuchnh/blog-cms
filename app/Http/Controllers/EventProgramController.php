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
        $item = $this->loadSettingItem($setting, 'eventprogram');

        $event = $this->loadSettingItem($setting, 'event');
        $program = $this->loadSettingItem($setting, 'program');

        // Set SEO information
        $this->setHeaderSeo($item);

        return view('page.event.index', [
            'item'     => $this->loadContent($item),
            'event'    => $event,
            'event_content' => $this->loadContent($event),
            'program'  => $program,
            'program_content' => $this->loadContent($program),
            'banner'   => isset($item->banner->url) && $item->banner->url ? $item->banner->url : null,
            'navigate' => 'event-program',
            'slug'     => 'event-program',
        ]);
    }

    /**
     * @param $setting
     * @param $slug
     * @return mixed|null
     */
    private function loadSettingItem($setting, $slug)
    {
        return isset($setting[$slug]) && $setting[$slug] ? json_decode($setting[$slug]) : null;
    }

    /**
     * @param $item
     * @return String|null
     */
    private function loadContent($item)
    {
        // Key language
        if (isset($item->content) && $item->content) {
            $locale_key = array_search(app()->getLocale(), array_column($item->content, 'locale'));
        }

        return isset($locale_key) && isset($item->content[$locale_key]) && $item->content[$locale_key] ? $item->content[$locale_key] : null;
    }

    /**
     * @param $item
     */
    private function loadThumbnail($item)
    {
        return isset($item->thumbnail) && $item->thumbnail['url'] ? $item->thumbnail['url'] : null;
    }

    /**
     * @param null $item
     */
    private function setHeaderSeo($item = null)
    {
        // Set SEO information
        if ($item && isset($item->seo) && $item->seo) {
            // Key language
            $locale_key_seo = array_search(app()->getLocale(), array_column($item->seo, 'locale'));

            \SEOMeta::setTitle($item->seo[$locale_key_seo]->title);
            \SEOMeta::setDescription($item->seo[$locale_key_seo]->description);
        }
    }
}
