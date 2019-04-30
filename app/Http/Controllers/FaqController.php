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

        return view('page.why.faq', [
            'data'     => $posts,
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
}
