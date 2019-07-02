<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Post;

class PostController extends Controller
{
    //Set Type
    public $type_post = 'post_blogs';

    // return data for index function
    public $returnDataIndex = [
        'view'    => 'page.blog.index-mix',
        'plugins' => [
            'navigate'    => 'resources',
            'subnavigate' => 'blogs',
            'slug'        => 'blog',
        ],
    ];

    // return data for detail function
    public $returnDataDetail = [
        'view'    => 'page.blog.item',
        'plugins' => [
            'navigate'    => 'resources',
            'subnavigate' => 'blogs',
            'slug'        => 'blog',
        ],
    ];

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Post $posts)
    {
        $paginator = $request->get('perPage');

        // Load list posts
        if (! $request->get('perPage')) {
            $posts_featured = $this->getFeaturedPost($posts, $request);
        }

        $posts_index = $posts->ofLocale(app()->getLocale())
                             ->when($this->type_post, function ($query) {
                                 /**@var \Illuminate\Database\Eloquent\Builder $query */
                                 $query->where('type', $this->type_post);
                             })
                             ->whereHas('metas', function ($query) use ($request) {
                                 /**@var \Illuminate\Database\Eloquent\Builder $query */
                                 $query->where('meta_key', '!=', 'featured');
                             })
                             ->when($request->input('title'), function (
                                 $query
                             ) use ($request) {
                                 /**@var \Illuminate\Database\Eloquent\Builder $query */
                                 $query->where('title', 'LIKE', '%'.$request->input('title').'%');
                             })
                             ->when($request->input('year'), function ($query) use ($request) {
                                 /**@var \Illuminate\Database\Eloquent\Builder $query */
                                 $query->whereHas('metas', function ($query) use ($request) {
                                     /**@var \Illuminate\Database\Eloquent\Builder $query */
                                     $query->where('meta_key', '=', 'event')->whereRaw(/**@lang MySQL */
                                         'YEAR(JSON_EXTRACT_NESTED(meta_value,"date")) = '.intval($request->input('year')));
                                 });
                             })
                             ->when($request->input('day'), function ($query) use ($request) {
                                 /**@var \Illuminate\Database\Eloquent\Builder $query */
                                 $query->whereHas('metas', function ($query) use ($request) {
                                     /**@var \Illuminate\Database\Eloquent\Builder $query */
                                     $query->where('meta_key', '=', 'event')->whereRaw(/**@lang MySQL */
                                         'DAY(JSON_EXTRACT_NESTED(meta_value,"date")) = '.intval($request->input('day')));
                                 });
                             })
                             ->when($request->input('month'), function ($query) use ($request) {
                                 /**@var \Illuminate\Database\Eloquent\Builder $query */
                                 $query->whereHas('metas', function ($query) use ($request) {
                                     /**@var \Illuminate\Database\Eloquent\Builder $query */
                                     $query->where('meta_key', '=', 'event')->whereRaw(/**@lang MySQL */
                                         'MONTH(JSON_EXTRACT_NESTED(meta_value,"date")) = '.intval($request->input('month')));
                                 });
                             })
                             ->sortable([$request->get('sort') => $request->get('direction')])
                             ->orderBy('id', 'desc')
                             ->paginate($paginator);

        if (! $request->get('perPage')) {
            $posts = $posts_featured->merge($posts_index);
        } else {
            $posts = $posts_index;
        }

        $return = [
            'data'   => $this->loadTransformDataPost($posts),
            'links'  => $posts_index->links(),
            'banner' => $this->loadBannerTop($this->returnDataIndex['plugins']['slug']),
        ];

        // load SEO
        $this->loadSeoData($this->returnDataIndex['plugins']['slug']);

        return view($this->returnDataIndex['view'], array_merge($return, $this->returnDataIndex['plugins']));
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $slug)
    {
        if (! $slug ) {
            abort(404);
        }

        $data = $this->getPostDetail($slug);

        if ($data instanceof RedirectResponse) {
            return $data;
        }

        $others = $this->getPostOthers(collect($data));

        $return = [
            'item'   => $data,
            'others' => $others,
        ];

        $this->setHeaderMeta($this->getMetaPost($data));

        return view($this->returnDataDetail['view'], array_merge($return, $this->returnDataDetail['plugins']));
    }

    /**
     * Get Post Information with Cache Store
     *
     * @param slug $slug
     * @return mixed
     */
    private function getPostDetail($slug = null)
    {
        if (! $slug ) {
            abort(404);
        }
        
        if (Cache::has('post_'.app()->getLocale().'_'.$slug)) {
            return Cache::get('post_'.app()->getLocale().'_'.$slug);
        } else {
            $post = Post::whereTranslation('slug', $slug)->where('publish', 1)->firstOrFail();

            /**
             * @var $postTranslation \App\Models\PostTranslation
             */
            $postTranslation = $post->translate()->where('slug', $slug)->firstOrFail();

            if ($postTranslation->locale !== app()->getLocale()) {
                $slug = [
                    'slug' => $postTranslation->post->translate(app()->getLocale())->slug,
                ];

                return redirect()->route(\request()->route()->getName(), $slug);
            }

            $post = Post::ofLocale(app()->getLocale())->where('slug', $slug)->firstOrFail();

            $data = $this->loadTransformDataPost($post);

            Cache::put('post_'.app()->getLocale().'_'.$slug, $data, 60);

            return $data;
        }
    }

    /**
     * get other posts & storage in cache
     *
     * @param \Illuminate\Support\Collection $post
     * @return mixed
     */
    private function getPostOthers($post)
    {
        if (Cache::has('post_others_'.$post['slug'])) {
            return Cache::get('post_others_'.$post['slug']);
        } else {
            $isOtherBoolean = array_key_exists('meta', $post->toArray()) && isset($post['meta']['others']) ? true : false;

            $others = Post::ofLocale(app()->getLocale())
                          ->where('type', $this->type_post)
                          ->where('slug', '!=', $post['slug'])
                          ->where('publish', 1)
                          ->when($isOtherBoolean, function (
                              $query
                          ) use ($post) {
                              $relatePosts = array_column((array) $post['meta']['others'], 'id');

                              /**@var \Illuminate\Database\Query\Builder $query */
                              return $query->whereIn('id', $relatePosts);
                          })
                          ->limit(3)
                          ->orderBy('id', 'DESC')
                          ->get();

            $data = $this->loadTransformDataPost($others);

            Cache::put('post_others_'.$post['slug'], $data, 60);

            return $data;
        }
    }

    /**
     * load SEO data
     *
     * @param null $slug
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
        }
    }

    /**
     * load banner top
     *
     * @param $slug
     * @return |null
     */
    private function loadBannerTop($slug)
    {
        if ($slug) {
            $setting = (new \App\Http\View\Composers\SettingComposer)->getSettingInformation();

            // load content
            $item = isset($setting[$slug]) && $setting[$slug] ? json_decode($setting[$slug]) : null;

            return isset($item->banner->url) && $item->banner->url ? $item->banner->url : null;
        } else {
            return null;
        }
    }

    /**
     * Set Meta content for detail
     *
     * @param $meta
     */
    private function setHeaderMeta($meta)
    {
        \SEOMeta::setTitle($meta['title']);
        \SEOMeta::setKeywords($meta['keywords']);
        \SEOMeta::setDescription($meta['description']);

        \OpenGraph::setDescription($meta['description']);
        \OpenGraph::setTitle($meta['title']);

        if (isset($meta['facebook_image']) && $meta['facebook_image']) {
            \OpenGraph::addImage($meta['facebook_image']);
        }
    }

    public function getFeaturedPost($posts, $request)
    {
        return $posts->ofLocale(app()->getLocale())
                     ->when($this->type_post, function ($query) {
                         /**@var \Illuminate\Database\Eloquent\Builder $query */
                         $query->where('type', $this->type_post);
                     })
                     ->when($request->input('title'), function (
                         $query
                     ) use ($request) {
                         /**@var \Illuminate\Database\Eloquent\Builder $query */
                         $query->where('title', 'LIKE', '%'.$request->input('title').'%');
                     })
                     ->whereHas('metas', function ($query) use ($request) {
                         /**@var \Illuminate\Database\Eloquent\Builder $query */
                         $query->where('meta_key', '=', 'featured')
                               ->where('meta_value', '=', 1);
                     })
                     ->where('publish', 1)
                     ->sortable([$request->get('sort') => $request->get('direction')])
                     ->orderBy('id', 'desc')
                     ->get();
    }
}
