<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostRequest;
use App\Http\Requests\API\UpdatePostRequest;
use App\Models\Post;
use App\Models\Taxonomy;
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
        /**
         * @param \App\Models\Post $post
         */
        $post = Post::create($request->validated());

        // Handle tag
        $this->createTag($post, $request);

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

        // Handle tag
        $this->createTag($post, $request);

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
        $post->meta()->delete();
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

    /**
     * @param \App\Models\Post $post
     * @param \Illuminate\Http\Request $request
     */
    private function createTag(Post $post, Request $request) {
        // Get current tags and request tags
        $current = $post->taxonomies()->get()->toArray();
        $change = $request->tag;

        // Handle tag function
        $handle = function ($items) use ($post) {
            foreach ($items as $item) {
                $input = Taxonomy::query()->where('name', $item['name'])->get();

                // Check tag exists or not
                if ($input->isEmpty()) {
                    // Create new tag and attach to pivot table
                    $model = new Taxonomy();
                    $model->fill($item);
                    $post->taxonomies()->save($model);
                } else {
                    // Attach to pivot table if it exists
                    $post->taxonomies()->attach($input);
                }
            }

        };

        if (empty($current)) {
            // If post doesn't have any tags, jump to handle function
            $attached = $change;
            $handle($attached);
        } else {
            // Compare current variable to change variable
            $intersect = array_intersect(array_column($current, 'name'), array_column($change, 'name'));
            $attached = array_diff(array_column($change, 'name'), $intersect);
            $detached = array_diff(array_column($current, 'name'), $intersect);

            // Get items which need to attach or detach
            $attachItems = array_filter($change, function ($item) use ($attached) {
                return in_array($item['name'], $attached);
            });
            $detachItems = Taxonomy::query()->whereIn('name', $detached)->get();

            $handle($attachItems);
            $post->taxonomies()->detach($detachItems);
        }
    }
}
