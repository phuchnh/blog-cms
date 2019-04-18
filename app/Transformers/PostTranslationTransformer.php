<?php

namespace App\Transformers;

use App\Models\PostTranslation;
use Flugg\Responder\Transformers\Transformer;

class PostTranslationTransformer extends Transformer
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
     * @param \App\Models\PostTranslation $postTranslation
     * @return array
     */
    public function transform(PostTranslation $postTranslation)
    {
        return $postTranslation->toArray();
    }
}
