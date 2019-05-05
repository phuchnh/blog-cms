<?php

namespace App\Http\Controllers;

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
        $posts = $posts->ofLocale(app()->getLocale())
                       ->where('type', $this->type_post)
                       ->when($request->input('title'), function ($query) use ($request) {
                           /**@var \Illuminate\Database\Eloquent\Builder $query */
                           $query->where('title', 'LIKE', '%'.$request->input('title').'%');
                       })
                       ->when($request->input('year'), function ($query) use ($request) {
                           /**@var \Illuminate\Database\Eloquent\Builder $query */
                           $query->whereHas('metas', function ($query) use ($request) {
                               /**@var \Illuminate\Database\Eloquent\Builder $query */
                               $query->where('meta_key', '=', 'event')
                                     ->whereRaw(/**@lang MySQL */
                                         'YEAR(JSON_EXTRACT_NESTED(meta_value,"date")) = '.intval($request->input('year')));
                           });
                       })
                       ->when($request->input('day'), function ($query) use ($request) {
                           /**@var \Illuminate\Database\Eloquent\Builder $query */
                           $query->whereHas('metas', function ($query) use ($request) {
                               /**@var \Illuminate\Database\Eloquent\Builder $query */
                               $query->where('meta_key', '=', 'event')
                                     ->whereRaw(/**@lang MySQL */
                                         'DAY(JSON_EXTRACT_NESTED(meta_value,"date")) = '.intval($request->input('day')));
                           });
                       })
                       ->when($request->input('month'), function ($query) use ($request) {
                           /**@var \Illuminate\Database\Eloquent\Builder $query */
                           $query->whereHas('metas', function ($query) use ($request) {
                               /**@var \Illuminate\Database\Eloquent\Builder $query */
                               $query->where('meta_key', '=', 'event')
                                     ->whereRaw(/**@lang MySQL */
                                         'MONTH(JSON_EXTRACT_NESTED(meta_value,"date")) = '.intval($request->input('month')));
                           });
                       })
                       ->sortable([$request->get('sort') => $request->get('direction')])
                       ->orderBy('id', 'desc')->paginate($paginator);

        $return = [
            'data'  => $this->loadTransformDataPost($posts),
            'links' => $posts->links(),
        ];

        // load SEO
        $this->loadSeoData($this->returnDataIndex['plugins']['slug']);

        return view($this->returnDataIndex['view'], array_merge($return, $this->returnDataIndex['plugins']));
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $slug)
    {
        $data = $this->getPostDetail($slug);

        $others = $this->getPostOthers(collect($data));

        $return = [
            'item'   => $data,
            'others' => $others,
            'meta'   => $this->getMetaPost($data),
        ];

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
        if (Cache::has('post_'.app()->getLocale().'_'.$slug)) {
            return Cache::get('post_'.app()->getLocale().'_'.$slug);
        } else {
            $post = Post::ofLocale(app()->getLocale())
                        ->where('slug', $slug)->firstOrFail();

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
                          ->when($isOtherBoolean, function ($query) use ($post) {
                              $relatePosts = array_column((array) $post['meta']['others'], 'id');

                              /**@var \Illuminate\Database\Query\Builder $query */
                              return $query->whereIn('id', $relatePosts);
                          })->limit(3)->orderBy('id', 'DESC')->get();

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
}
