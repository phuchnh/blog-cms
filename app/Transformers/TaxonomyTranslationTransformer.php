<?php

namespace App\Transformers;

use App\Models\TaxonomyTranslation;
use Flugg\Responder\Transformers\Transformer;

class TaxonomyTranslationTransformer extends Transformer
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
     * @param \App\Models\TaxonomyTranslation $taxonomyTranslation
     * @return array
     */
    public function transform(TaxonomyTranslation $taxonomyTranslation)
    {
        return $taxonomyTranslation->toArray();
    }
}
