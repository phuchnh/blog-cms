<?php

namespace App\Http\Controllers;

use App\Transformers\PostTransformer;
use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Collection;

class BlogController extends API\ApiBaseController
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

        // Transform Post Data
        $data = responder()
            ->success($posts, PostTransformer::class)
            ->toCollection();

        return view('page.blog.index-row', [
            'data'     => $data['data'],
            'links'    => $posts->links(),
            'navigate' => 'results',
            'slug'     => 'blog',
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
        $post = Post::findBySlugOrFail($slug);

        $others = Post::where('id', '!=', $post->id)->limit(3)->orderBy('id', 'DESC')->get();

        $data = responder()
            ->success($post, PostTransformer::class)
            ->toCollection();

        $dataOther = responder()
            ->success($others, PostTransformer::class)
            ->toCollection();

        return view('page.blog.item', [
            'item'     => $data['data'],
            'others'   => $dataOther['data'],
            'navigate' => 'results',
            'slug'     => 'blog',
        ]);
    }
}
