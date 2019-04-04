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
     * @var PostTransformer
     */
    private $postTransformer;

    public function __construct(PostTransformer $postTransformer)
    {
        $this->postTransformer = $postTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Post $posts)
    {
        return $this->ok($posts->with(['media', 'postMeta'])
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

        return $this->ok((new PostTransformer)->transformWithMeta($post->load('media', 'postMeta')));
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

        if ($request->get('date')) {
            $data = [];
            $data['meta_key'] = 'event_date';
            $data['meta_value'] = $request->get('date');
            $postMeta = new PostMeta();
            $postMeta->fill($data);
            $post->postMeta()->save($postMeta);
        }

        if ($request->get('location')) {
            $data = [];
            $data['meta_key'] = 'event_location';
            $data['meta_value'] = $request->get('location');
            $postMeta = new PostMeta();
            $postMeta->fill($data);
            $post->postMeta()->save($postMeta);
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
        $postMetaDate = $post->postMeta()->where('meta_key', 'event_date')->first();
        $postMetaDate->meta_value = $request->get('date');
        $postMetaDate->save();
        $postMetaLocation = $post->postMeta()->where('meta_key', 'event_location')->first();
        $postMetaLocation->meta_value = $request->get('location');
        $postMetaLocation->save();

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
