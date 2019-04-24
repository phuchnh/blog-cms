<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Post;

class BlogController extends Controller
{
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
        $posts = $posts
            ->where('type', 'blog')
            ->when($request->input('title'), function ($query) use ($request) {
                /**@var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('title', 'LIKE', '%'.$request->input('title').'%');
            })
            ->sortable([$request->get('sort') => $request->get('direction')])
            ->orderBy('id', 'desc')->paginate($paginator);

        return view('page.blog.index-mix', [
            'data'        => $this->loadTransformData($posts),
            'links'       => $posts->links(),
            'navigate'    => 'resources',
            'subnavigate' => 'blogs',
            'slug'        => 'blog',
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
            'subnavigate' => 'blogs',
            'slug'        => 'blog',
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
        if (Cache::has('post_'.$slug)) {
            return Cache::get('post_'.$slug);
        } else {
            $post = Post::findBySlugOrFail($slug);

            $data = $this->loadTransformData($post);

            Cache::put('post_'.$slug, $data, 60);

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

            $others = Post::where('slug', '!=', $post['slug'])
                          ->when($isOtherBoolean, function ($query) use ($post) {
                              $relatePosts = json_decode($post['meta']['others']);

                              /**@var \Illuminate\Database\Query\Builder $query */
                              return $query->whereIn('id', array_column((array) $relatePosts, 'key'));
                          })->limit(3)->orderBy('id', 'DESC')->get();

            $data = $this->loadTransformData($others);

            Cache::put('post_others_'.$post['slug'], $data, 60);

            return $data;
        }
    }
}
