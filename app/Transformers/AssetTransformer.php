<?php

namespace App\Transformers;

use App\Models\Asset;
use Flugg\Responder\Transformers\Transformer;

class AssetTransformer extends Transformer
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
     * @param \App\Models\Asset $asset
     * @return array
     */
    public function transform(Asset $asset)
    {
        return $asset->toArray();
    }
}
