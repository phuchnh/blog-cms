<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Post;

class FaqController extends Controller
{
    //Set Type
    const TYPE = 'post_faq';

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Post $posts)
    {
        // Load list posts
        $posts = $this->getPosts($request, $posts);

        // load meta data
        $item = $this->loadSeoData('faq');

        return view('page.why.faq', [
            'data'     => $posts,
            'item'     => $item,
            'navigate' => 'whymindfullness',
            'slug'     => 'faq',
        ]);
    }

    /**
     * @param $request
     * @param $posts
     * @return mixed
     */
    private function getPosts($request, $posts)
    {
        if (Cache::has('post_faq')) {
            return Cache::get('post_faq');
        } else {
            $data = $posts
                ->ofLocale(app()->getLocale())
                ->where('type', self::TYPE)
                ->when($request->input('title'), function ($query) use ($request) {
                    /**@var \Illuminate\Database\Eloquent\Builder $query */
                    $query->where('title', 'LIKE', '%'.$request->input('title').'%');
                })
                ->sortable([$request->get('sort') => $request->get('direction')])
                ->orderBy('id', 'desc')->get();

            Cache::put('post_faq', $this->loadTransformDataPost($data), 600);

            return $data;
        }
    }

    /**
     * @param null $slug
     * @return |null
     */
    private function loadSeoData($slug = null)
    {
        if ($slug) {
            $setting = (new \App\Http\View\Composers\SettingComposer)->getSettingInformation();

            // load content
            $item = isset($setting[$slug]) && $setting[$slug] ? json_decode($setting[$slug]) : null;

            // Set SEO information
            if (isset($item->seo) && $item->seo) {
                // Key language
                $locale_key_seo = array_search(app()->getLocale(), array_column($item->seo, 'locale'));

                \SEOMeta::setTitle($item->seo[$locale_key_seo]->title);
                \SEOMeta::setDescription($item->seo[$locale_key_seo]->description);
            }

            // Key language
            if (isset($item->content) && $item->content) {
                $locale_key = array_search(app()->getLocale(), array_column($item->content, 'locale'));
            }

            return isset($locale_key) && isset($item->content[$locale_key]) && $item->content[$locale_key] ? $item->content[$locale_key] : null;
        } else {
            return null;
        }
    }
}
