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
        $postMeta = $post->postMetas
            ->map(function ($value) {
                return [$value->meta_key => $value->meta_value];
            })
            ->collapse()
            ->toArray();

        return $this->ok(['postMeta' => $postMeta]);
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
        $models = $this->createInstancePostMeta($post, $request->validated());
        $post_metas = $post->postMetas()->saveMany($models);

        return $this->created($post_metas);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @param \App\Models\PostMeta $metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Post $post, PostMeta $metum)
    {
        return $this->ok($metum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @param \App\Models\PostMeta $metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post, PostMeta $metum)
    {
        $metum->fill($request->all());
        $metum->save();

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
        //$inputArray = $request->validated();
        //
        //$metaTemp = $post->meta();
        //
        //$metaTemp->delete();
        //
        //$metaTemp->saveMany($this->createInstancePostMeta($inputArray));
        //
        //return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @param \App\Models\PostMeta $metum
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Post $post, PostMeta $metum)
    {
        $metum->delete();

        return $this->noContent();
    }

    /**
     * create Instance PostMeta
     *
     * @param \App\Models\Post $post
     * @param array $data
     * @return array
     */
    private function createInstancePostMeta(Post $post, array $data)
    {
        $models = [];
        $values = $data['metas'];

        $metaValues = $post->postMetas()->pluck('meta_value')->toArray();

        foreach ($values as $value) {
            if (in_array($value['meta_value'], $metaValues, true)) {
                $models[] = $post->postMetas()->where('meta_value', $value['meta_value'])->first();
            } else {
                $meta = new PostMeta();
                $meta->fill($value);
                $models[] = $meta;
            }
        }

        return $models;
    }
}
