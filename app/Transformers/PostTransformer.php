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
        return $post->toArray();
    }
}
