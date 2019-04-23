<?php

namespace App\Transformers;

use App\Models\Faq;
use App\Models\TaxonomyTranslation;
use Flugg\Responder\Transformers\Transformer;
use League\Fractal\Resource\ResourceInterface;

class FaqTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'translations' => PostTranslationTransformer::class,
        'taxonomies'   => TaxonomyTransformer::class,
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
     * @param \App\Models\Faq $faq
     * @return array
     */
    public function transform(Faq $faq)
    {
        return $faq->toArray();
    }
}
