<?php

namespace App\Transformers;

use App\Models\Faq;
use Flugg\Responder\Transformers\Transformer;

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
        Faq::disableAutoloadTranslations();

        return $faq->toArray();
    }
}
