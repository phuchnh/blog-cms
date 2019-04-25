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
        'taxonomies'   => TaxonomyTransformer::class,
        'metas'        => MetaTransformer::class,
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
            $this->transformMeta($post)
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
        $meta = new MetaTransformer();

        return ['meta' => $meta->transformArray($post->metas)];
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

        return $post->toArray();
    }

    /**
     * Transform tag
     *
     * @param \App\Models\Post $post
     * @return array
     */
    private function transformTag(\App\Models\Post $post)
    {
        return ['tag' => $post->taxonomies];
    }
}
