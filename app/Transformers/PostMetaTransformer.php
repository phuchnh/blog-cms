<?php

namespace App\Transformers;

use App\Models\PostMeta;
use Flugg\Responder\Transformers\Transformer;

class PostMetaTransformer extends Transformer
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
     * @param  \App\Models\PostMeta $postMeta
     * @return array
     */
    public function transform(PostMeta $postMeta)
    {
        return [
            $postMeta->meta_key => $postMeta->meta_value,
        ];
    }

    /**
     * @param array $postMetas
     * @return @mix
     */
    public function transformArray($postMetas)
    {
        $result = [];
        foreach ($postMetas as $meta) {
            $result[$meta->meta_key] = $meta->meta_value;
        }

        return $result;
    }
}
