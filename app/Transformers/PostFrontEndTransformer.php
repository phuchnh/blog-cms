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
        'meta',
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
        'meta',
        'taxonomies'   => TaxonomyTransformer::class,
    ];

    /**
     * Transform the model.
     *
     * @param \App\Models\Post $post
     * @return array
     */
    public function transform(\App\Models\Post $post)
    {
        $translations = $post->translations->toArray();
        $locale_key = array_search(app()->getLocale(), array_column($translations, 'locale'));

        return [
            "locale" => $post->locale,
            "title" => $translations[$locale_key]['title'],
            "slug" => $translations[$locale_key]['slug'],
            "description" => $translations[$locale_key]['description'],
            "content" => $translations[$locale_key]['content'],
            "id" => $translations[$locale_key]['id'],
            "publish" => $post->publish,
            "type" => $post->type,
            "created_at" => $post->created_at,
            "updated_at" => $post->updated_at,
            "deleted_at" => $post->deleted_at,
        ];
    }

    /**
     * @param $value
     * @return array
     */
    public function includeMeta($value)
    {
        return (new MetaFrontEndTransformer())->transformArray($value->metas);
    }
}
