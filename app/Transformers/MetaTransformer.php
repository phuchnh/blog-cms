<?php

namespace App\Transformers;

use App\Models\Meta;
use Flugg\Responder\Transformers\Transformer;

class MetaTransformer extends Transformer
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
     * @param \App\Models\Meta $meta
     * @return array
     */
    public function transform(Meta $meta)
    {
        return $meta->toArray();
    }

    /**
     * @param $metas
     * @return array @mix
     */
    public function transformArray($metas)
    {
        $result = [];
        foreach ($metas as $meta) {
            $result[$meta->meta_key] = $meta->meta_value;
        }

        return $result;
    }

}
