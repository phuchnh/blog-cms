<?php

namespace App\Transformers;

use App\Models\Post;
use App\Models\PostMeta;
use Flugg\Responder\Transformers\Transformer;

class PostMetaTestTransformer extends Transformer
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
     * @param \App\Models\PostMeta $postMeta
     * @return array
     */
    public function transform(PostMeta $postMeta)
    {
        return [
            $postMeta->meta_key => $postMeta->meta_value,
        ];
    }
}
