<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;

class PostFrontEndTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'translations' => PostTranslationTransformer::class,
        'taxonomies'   => TaxonomyTransformer::class,
        'meta'
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
        'meta'
    ];

    //protected $availableIncludes = ['metas'];
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

    public function includeMeta($value){
        return (new MetaFrontEndTransformer())->transformArray($value->metas);
    }
}
