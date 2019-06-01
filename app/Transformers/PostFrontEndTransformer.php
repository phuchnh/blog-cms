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
        'route',
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
        'meta',
        'route',
        'taxonomies' => TaxonomyTransformer::class,
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
            "locale"      => $post->locale,
            "title"       => $translations[$locale_key]['title'],
            "slug"        => $translations[$locale_key]['slug'],
            "description" => $translations[$locale_key]['description'],
            "content"     => $translations[$locale_key]['content'],
            "id"          => $translations[$locale_key]['id'],
            "publish"     => $post->publish,
            "type"        => $post->type,
            "created_at"  => $post->created_at,
            "updated_at"  => $post->updated_at,
            "deleted_at"  => $post->deleted_at,
            "sort"        => $this->getSort($post),
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

    /**
     * @param $value
     * @return array
     */
    public function getSort($value)
    {
        $metaArray = (new MetaFrontEndTransformer())->transformArray($value->metas);

        if (key_exists('sort', $metaArray)) {
            return intval($metaArray['sort']);
        } else {
            return 0;
        }
    }

    /**
     * load Route attribute
     *
     * @param $value
     * @return mixed|string
     */
    public function includeRoute($value)
    {
        $arrayType = [
            'post_blogs'    => 'blogitem',
            'post_pratices' => 'practiceitem',
            'post_guides'   => 'guideitem',
            'post_presses'  => 'pressitem',
            'post_events'   => 'eventitem',
            'post_programs' => 'programitem',
            'post_faq'      => 'faq',
        ];

        return isset($arrayType[$value->type]) ? [$arrayType[$value->type]] : ['home'];
    }
}
