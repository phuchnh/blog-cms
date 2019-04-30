<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Post;

class PracticeController extends Controller
{
    //Set Type
    const TYPE = 'post_pratices';

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
                       ->where('type', self::TYPE)
                       ->when($request->input('title'), function ($query) use ($request) {
                           /**@var \Illuminate\Database\Eloquent\Builder $query */
                           $query->where('title', 'LIKE', '%'.$request->input('title').'%');
                       })
                       ->sortable([$request->get('sort') => $request->get('direction')])
                       ->orderBy('id', 'desc')->paginate($paginator);

        return view('page.blog.index-row', [
            'data'        => $this->loadTransformDataPost($posts),
            'links'       => $posts->links(),
            'navigate'    => 'resources',
            'subnavigate' => 'daily-practices',
            'slug'        => 'practice',
        ]);
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

        return view('page.blog.item', [
            'item'        => $data,
            'others'      => $others,
            'navigate'    => 'resources',
            'subnavigate' => 'daily-practices',
            'slug'        => 'practice',
            'meta'        => $this->getMetaPost($data),
        ]);
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
}
