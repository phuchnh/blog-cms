<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;

class PostTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param \App\Models\Post $post
     * @return array
     */
    public function transform(\App\Models\Post $post)
    {
        return array_merge(
            $post->toArray(),
            $this->transformMeta($post),
            $this->transformMedia($post)
        );
    }

    /**
     * Transform meta array to one
     *
     * @param \App\Models\Post $post
     * @return array
     */
    private function transformMeta(\App\Models\Post $post)
    {
        $postMeta = new PostMetaTransformer();

        return ['meta' => $postMeta->transformArray($post->meta)];
    }

    /**
     * transform media thumbnail
     *
     * @param \App\Models\Post $post
     * @return array
     */
    private function transformMedia(\App\Models\Post $post)
    {
        if ($post->media()->count() > 0) {
            $post->thumbnail = $post->media()->thumbnailUrl();
        } else {
            $post->thumbnail = null;
        }

        return ['thumbnail' => $post->thumbnail];
    }
}