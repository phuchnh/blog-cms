<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostMetaRequest;
use App\Http\Requests\API\UpdatePostMetaRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostMetaController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Post $post)
    {
        return $this->ok($post->postMeta);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\CreatePostMetaRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePostMetaRequest $request, Post $post)
    {
        $postMeta = $post->postMeta()->createMany($request->validated());
        dd($postMeta);
        return $this->created($postMeta);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @param string $postMeta
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Post $post, $postMeta)
    {
        $postMeta = $post->postMeta()->findOrFail($postMeta);

        return $this->ok($postMeta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\API\UpdatePostMetaRequest $request
     * @param \App\Models\Post $post
     * @param string $postMeta
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePostMetaRequest $request, Post $post, $postMeta)
    {
        $postMeta = $post->postMeta()->findOrFail($postMeta);
        $postMeta->fill($request->validated());
        $postMeta->save();

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @param string $postMeta
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Post $post, $postMeta)
    {
        $postMeta = $post->postMeta()->findOrFail($postMeta);
        $postMeta->delete();

        return $this->noContent();
    }
}
