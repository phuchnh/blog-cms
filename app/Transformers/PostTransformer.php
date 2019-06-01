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
        'thumbnail',
        'sort',
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

    /**
     * @param $post
     * @return string
     */
    public function includeThumbnail($post)
    {
        $metasArray = $post->metas->toArray();
        if ($metasArray) {
            $key = array_search('thumbnail', array_column($metasArray, 'meta_key'));

            return $key ? [$metasArray[$key]['meta_value']['url']] : [];
        } else {
            return [];
        }
    }

    /**
     * @param $post
     * @return string
     */
    public function includeSort($post)
    {
        $metasArray = $post->metas->toArray();
        if ($metasArray) {
            $key = array_search('sort', array_column($metasArray, 'meta_key'));

            return $key ? [$metasArray[$key]['meta_value']] : [];
        } else {
            return [];
        }
    }
}
