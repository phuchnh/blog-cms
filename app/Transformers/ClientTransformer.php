<?php

namespace App\Transformers;

use App\Models\Client;
use Flugg\Responder\Transformers\Transformer;

class ClientTransformer extends Transformer
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
     * @param \App\Models\Client $client
     * @return array
     */
    public function transform(Client $client)
    {
        $metas = $client->metas
            ->map(function ($value) {
                return [$value->meta_key => $value->meta_value];
            })
            ->collapse()
            ->toArray();

        $client->makeHidden('metas');
        $result = $client->toArray();

        $result['meta'] = $metas;

        return $result;
    }
}
