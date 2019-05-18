<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMetaRequest;
use App\Http\Requests\API\UpdateMetaRequest;
use App\Models\Meta;
use App\Models\PostMeta;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Arr;

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
        $metas = $post->metas
            ->map(function ($value) {
                return [$value->meta_key => $value->meta_value];
            })
            ->collapse()
            ->toArray();

        return $this->ok(['metas' => $metas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\CreateMetaRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMetaRequest $request, Post $post)
    {
        $metas = $this->updateOrCreateMeta($post, $request->validated());

        return $this->created($metas);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @param \App\Models\Meta $metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Post $post, Meta $metum)
    {
        return $this->ok($metum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\API\UpdateMetaRequest $request
     * @param \App\Models\Post $post
     * @param \App\Models\Meta $metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMetaRequest $request, Post $post, Meta $metum)
    {
        $metum->fill($request->all());
        $post->metas()->save($metum);

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @param \App\Models\Meta $metum
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Post $post, Meta $metum)
    {
        $metum->delete();

        return $this->noContent();
    }

    /**
     * Update or create meta values
     *
     * @param \App\Models\Post $post
     * @param array $metas
     * @return array
     */
    private function updateOrCreateMeta(Post $post, array $metas)
    {
        $models = [];
        $metas = Arr::get($metas, 'metas');
        foreach ($metas as $meta) {
            $models[] = $post->metas()->updateOrCreate(['meta_key' => $meta['meta_key']], $meta);
        }

        return $models;
    }
}
