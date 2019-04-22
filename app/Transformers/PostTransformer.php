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
            $this->transformTag($post)
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
        $postMeta = new MetaTransformer();

        return ['meta' => $postMeta->transformArray($post->metas)];
    }

    /**
     * transform media thumbnail
     *
     * @param \App\Models\Post $post
     * @return array
     */
    private function transformMedia(\App\Models\Post $post)
    {
        if ($post->medias()->count() > 0) {
            $post->thumbnail = $post->medias()->thumbnailUrl();
        } else {
            $post->thumbnail = null;
        }

        return ['thumbnail' => $post->thumbnail];
    }

    /**
     * Transform tag
     *
     * @param \App\Models\Post $post
     * @return array
     */
    private function transformTag(\App\Models\Post $post)
    {
        //$taxonomy = new TaxonomyTransformer();

        //return ['tag' => $taxonomy->transform($post->taxonomies)];
        return ['tag' => $post->taxonomies];
    }
}
