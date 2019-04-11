<?php

namespace App\Http\Controllers;

use App\Transformers\PostTransformer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Post;

class EventController extends Controller
{
    //Set Type
    const TYPE = 'event';

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
            ->where('type', self::TYPE)
            ->when($request->input('title'), function ($query) use ($request) {
                /**@var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('title', 'LIKE', '%'.$request->input('title').'%');
            })
            ->sortable([$request->get('sort') => $request->get('direction')])
            ->orderBy('id', 'desc')->paginate(5);

        // Transform Post Data
        $data = responder()
            ->success($posts, PostTransformer::class)
            ->toCollection();

        return view('page.event.list', [
            'data'        => $data['data'],
            'links'       => $posts->links(),
            'navigate'    => 'event',
            'subnavigate' => 'event',
            'slug'        => 'event',
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

        return view('page.about.pressitem', [
            'item'        => $data,
            'others'      => $others,
            'navigate'    => 'event',
            'subnavigate' => 'event',
            'slug'        => 'event',
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

            $data = responder()
                ->success($post, PostTransformer::class)
                ->toCollection();

            Cache::put('post_'.$slug, $data['data'], 60);

            return $data['data'];
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
                          ->where('type', self::TYPE)
                          ->when($isOtherBoolean, function ($query) use ($post) {
                              $relatePosts = json_decode($post['meta']['others']);

                              /**@var \Illuminate\Database\Query\Builder $query */
                              return $query->whereIn('id', array_column((array) $relatePosts, 'key'));
                          })->limit(3)->orderBy('id', 'DESC')->get();

            $data = responder()
                ->success($others, PostTransformer::class)
                ->toCollection();

            Cache::put('post_others_'.$post['slug'], $data['data'], 60);

            return $data['data'];
        }
    }
}
