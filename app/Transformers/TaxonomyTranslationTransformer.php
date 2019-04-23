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
        return array_merge(
            $taxonomyTranslation->toArray(),
            $this->transformMeta($taxonomyTranslation)
        );
    }

    /**
     * Transform meta array to one
     *
     * @param \App\Models\TaxonomyTranslation $taxonomyTranslation
     * @return array
     */
    private function transformMeta(TaxonomyTranslation $taxonomyTranslation)
    {
        $meta = new MetaTransformer();

        return ['meta' => $meta->transformArray($taxonomyTranslation->metas)];
    }
}
