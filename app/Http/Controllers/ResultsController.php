<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class ResultsController extends Controller
{
    public function index($slug = null)
    {
        $setting = (new \App\Http\View\Composers\SettingComposer)->getSettingInformation();

        if (! $slug) {
            return redirect(app()->getLocale().'/'.trans('routes.results').'/approach');
        }

        if ($slug === 'testimonial') {
            $data = \App\Models\Client::get();

            $controller = new \App\Http\Controllers\Controller();

            $clients = $controller->loadTransformData($data, \App\Transformers\ClientTransformer::class);
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

        // Testimonial
        $testimonials = $this->loadTestimonial();

        return view('page.results.'.$slug, [
            'clients'      => isset($clients) && $clients ? $clients : null,
            'testimonials' => $testimonials,
            'item'         => isset($locale_key) && isset($item->content[$locale_key]) && $item->content[$locale_key] ? $item->content[$locale_key] : null,
            'banner'       => isset($item->banner->url) && $item->banner->url ? $item->banner->url : null,
            'navigate'     => 'results',
            'slug'         => $slug,
        ]);
    }

    /**
     * load Testimonial
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function loadTestimonial()
    {
        if (Cache::has('post_testimonial_'.(app()->getLocale()))) {
            return Cache::get('post_testimonial_'.(app()->getLocale()));
        } else {
            $posts = Post::ofLocale(app()->getLocale())
                         ->where('type', 'post_testimonial')
                         ->orderBy('id', 'desc')->get();

            $data = $this->loadTransformDataPost($posts);

            Cache::put('post_testimonial_'.(app()->getLocale()), $data, 60);

            return $data;
        }
    }
}
