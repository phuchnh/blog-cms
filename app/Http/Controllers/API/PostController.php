<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostRequest;
use App\Http\Requests\API\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostMeta;
use App\Transformers\PostTransformer;
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
        $posts = $posts->when(
            $request->input('type'), function ($query) use ($request) {
            /**@var \Illuminate\Database\Eloquent\Builder $query */
            return $query->where('type', $request->input('type'));
        })->orderBy('id', 'desc')->get();

        return $this->ok($posts, PostTransformer::class);
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
        return $this->ok($post, PostTransformer::class);
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

        // update media
        $post = $this->updateMedia($post, $request);

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

        // update media
        $post = $this->updateMedia($post, $request);

        return $this->ok($post, PostTransformer::class);
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

    /**
     * @param \App\Models\Post $post
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Post
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\InvalidBase64Data
     */
    private function updateMedia(Post $post, Request $request)
    {
        if (is_array($thumbnail = $request->get('thumbnail'))) {
            $fileName = array_get($thumbnail, 'name');
            $fileContent = array_get($thumbnail, 'body');

            $post->addMediaFromBase64($fileContent)
                 ->usingFileName($fileName)
                 ->withCustomProperties(['thumbnail'])
                 ->toMediaCollection();
        }

        return $post;
    }
}
