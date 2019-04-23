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
        $metas = $this->ok($post->post_metas, PostMetaTestTransformer::class)->getData(true);
        $data = array_collapse_recursive($metas);

        return $this->ok($data);
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
     * @param string $postMeta
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Post $post, $postMeta)
    {
        $postMeta = $post->meta()->findOrFail($postMeta);

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
