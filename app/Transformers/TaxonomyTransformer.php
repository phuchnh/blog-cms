<?php

namespace App\Transformers;

use App\Models\Taxonomy;
use Flugg\Responder\Transformers\Transformer;

class TaxonomyTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'translations' => TaxonomyTranslationTransformer::class,
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
     * @param \App\Models\Taxonomy $taxonomy
     * @return array
     */
    public function transform(Taxonomy $taxonomy)
    {
        /**
         * @var $translations \App\Models\TaxonomyTranslation
         */
        $translation = $taxonomy->translations->where('locale', config('app.locale'))->first();

        $data = [
            'id'          => $taxonomy->id,
            'type'        => $taxonomy->type,
            'parent_id'   => $taxonomy->parent_id,
            'locale'      => $translation->locale,
            'title'       => $translation->title,
            'slug'        => $translation->slug,
            'description' => $translation->description,
        ];

        return array_merge(
            $data,
            $this->transformMeta($taxonomy)
        );
    }

    /**
     * Transform meta array to one
     *
     * @param \App\Models\Post $post
     * @return array
     */
    private function transformMeta(\App\Models\Taxonomy $taxonomy)
    {
        $meta = new MetaTransformer();

        return ['meta' => $meta->transformArray($taxonomy->metas)];
    }
}
