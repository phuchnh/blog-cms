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
        $translation = $taxonomy->translations()->where('locale', config('translatable.locale'))->first();

        return [
            'id'          => $taxonomy->id,
            'parent_id'   => $taxonomy->parent_id,
            'type'        => $taxonomy->type,
            'locale'      => $translation->locale,
            'title'       => $translation->title,
            'slug'        => $translation->slug,
            'description' => $translation->description,
        ];
    }
}
