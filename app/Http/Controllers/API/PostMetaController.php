<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostMetaRequest;
use App\Http\Requests\API\UpdatePostMetaRequest;
use App\Models\PostMeta;
use App\Transformers\PostMetaTestTransformer;
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
        $metas = $post->post_metas
            ->map(function ($value) {
                return [$value->meta_key => $value->meta_value];
            })
            ->collapse()
            ->toArray();

        return $this->ok($metas);
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
        $post_metas = $post->post_metas()->create($request->all());

        return $this->created($post_metas);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @param \App\Models\PostMeta $post_metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Post $post, PostMeta $post_metum)
    {
        return $this->ok($post_metum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @param \App\Models\PostMeta $post_metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post, PostMeta $post_metum)
    {
        $post_metum->fill($request->all());
        $post_metum->save();

        return $this->noContent();
    }

    /**
     * update Many Meta Data
     *
     * @param \App\Http\Requests\API\UpdatePostMetaRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMany(UpdatePostMetaRequest $request, Post $post)
    {
        $inputArray = $request->validated();

        $metaTemp = $post->meta();

        $metaTemp->delete();

        $metaTemp->saveMany($this->createInstancePostMeta($inputArray));

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

    /**
     * create Instance PostMeta
     *
     * @param $inputArray
     * @return array
     */
    private function createInstancePostMeta($inputArray)
    {
        foreach ($inputArray as $input) {
            if ($input['meta_value']) {
                $instance[] = new PostMeta($input);
            }
        }

        return $instance;
    }
}
