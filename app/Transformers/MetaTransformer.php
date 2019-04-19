<?php

namespace App\Transformers;

use App\Models\Meta;
use App\Models\Post;
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
        return [
            $meta->meta_key => $meta->meta_value,
        ];
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

    /**
     * @param \App\Models\Meta $meta
     * @return mixed
     */
    public function transformOthers(Meta $meta)
    {
        if ($meta->meta_key === 'others') {
            $result = Post::select(['id AS value', \DB::raw('CONVERT(id, CHAR(50)) AS "key"'), 'title AS label'])
                          ->whereIn('id', explode(',', $meta->meta_value))
                          ->get()
                          ->toArray();
        }

        return $result;
    }
}
