<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostRequest;
use App\Http\Requests\API\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends ApiBaseController
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
        return $this->ok($posts->with('media')
                               ->when($request->input('type'), function ($query) use ($request) {
                                   /**@var \Illuminate\Database\Eloquent\Builder $query */
                                   return $query->where('type', $request->input('type'));
                               })
                               ->orderBy('id', 'desc')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Post $post)
    {
        if ($post->media()->count() > 0) {
            $post->thumbnail = $post->media()->thumbnailUrl();
        } else {
            $post->thumbnail = null;
        }
        return $this->ok($post->load('media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\CreatePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\InvalidBase64Data
     */
    public function store(CreatePostRequest $request)
    {
        $post = Post::create($request->validated());
        if ($thumbnail = $request->get('thumbnail')) {
            $fileName = array_get($thumbnail, 'name');
            $fileContent = array_get($thumbnail, 'body');
            $post->addMediaFromBase64($fileContent)
                 ->usingFileName($fileName)
                 ->withCustomProperties(['thumbnail'])
                 ->toMediaCollection('thumbnail');
        }

        // request meta data
        // save

        return $this->created($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\API\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\InvalidBase64Data
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->fill($request->validated());
        $post->save();

        if (is_array($thumbnail = $request->get('thumbnail'))) {
            $fileName = array_get($thumbnail, 'name');
            $fileContent = array_get($thumbnail, 'body');
            $post->addMediaFromBase64($fileContent)
                 ->usingFileName($fileName)
                 ->withCustomProperties(['thumbnail'])
                 ->toMediaCollection();
        }

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return $this->noContent();
    }
}
