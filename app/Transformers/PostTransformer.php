<?php

namespace App\Transformers;

use App\Models\Post;
use Flugg\Responder\Transformers\Transformer;

class PostTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'translations' => PostTranslationTransformer::class,
    ];

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
        Post::disableAutoloadTranslations();
        
        return array_merge(
            $post->toArray(),
            $this->transformMeta($post),
            //$this->transformMedia($post),
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
