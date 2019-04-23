<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostRequest;
use App\Http\Requests\API\UpdatePostRequest;
use App\Models\Post;
use App\Models\Taxonomy;
use App\Models\TaxonomyTranslation;
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
        //$paginator = $request->get('perPage');
        //
        //$posts = $posts
        //    ->when($request->input('type'), function ($query) use ($request) {
        //        /**@var \Illuminate\Database\Eloquent\Builder $query */
        //        return $query->where('type', $request->input('type'));
        //    })->when($request->input('title'), function ($query) use ($request) {
        //        /**@var \Illuminate\Database\Eloquent\Builder $query */
        //        $query->where('title', 'LIKE', '%'.$request->input('title').'%');
        //    })
        //    ->sortable([$request->get('sort') => $request->get('direction')])
        //    ->orderBy('id', 'desc');
        //if ($request->input('trash')) {
        //    $posts = $posts->onlyTrashed();
        //}
        //$posts = $posts->paginate($paginator);

        if ($locale = $request->get('locale', config('app.locale'))) {
            $posts = $posts->ofLocale($locale);
        }

        if ($sort = $request->get('sort')) {
            $posts = $posts->sortable([
                $sort => $request->get('direction'),
            ]);
        }

        $result = $posts
            ->when($request->input('type'), function ($query) use ($request) {
                /**@var \Illuminate\Database\Eloquent\Builder $query */
                return $query->where('type', $request->input('type'));
            })
            ->when($request->input('title'), function ($query) use ($request) {
                /**@var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('title', 'LIKE', '%'.$request->input('title').'%');
            })
            ->get();

        if ($paginator = $request->get('perPage')) {
            $result = $posts->paginate($paginator);
        }

        return $this->ok($result);
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
        $post = new Post();

        $post->fill($request->all());

        if ($translations = $request->get('translations')) {
            foreach ($translations as $translation) {
                $post->translateOrNew($translation['locale'])->fill($translation);
            }
        }

        $post->save();

        // Handle tag
        if ($request->tag) {
            $this->createTag($post, $request);
        }

        return $this->created($post, PostTransformer::class);

        // save
        return $this->created($post);
    }

    /**
     * update a post
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post)
    {
        $post->fill($request->all());

        if ($translations = $request->get('translations')) {
            foreach ($translations as $translation) {
                $post->translateOrNew($translation['locale'])->fill($translation);
            }
        }

        $post->save();

        // Handle tag
        if ($request->tag) {
            $this->createTag($post, $request);
        }

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

    /**
     * @param \App\Models\Post $post
     * @param \Illuminate\Http\Request $request
     */
    private function createTag(Post $post, Request $request)
    {
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

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePermanently($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->meta()->delete();
        $post->forceDelete();

        return $this->noContent();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        Post::withTrashed()->findOrFail($id)->restore();

        return $this->noContent();
    }
}
