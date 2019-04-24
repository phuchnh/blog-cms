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
        return array_merge(
            $client->toArray(),
            $this->transformMeta($client)
        );
    }

    /**
     * Transform meta array to one
     *
     * @param \App\Models\Client $client
     * @return array
     */
    private function transformMeta(Client $client)
    {
        $meta = new MetaTransformer();

        return ['meta' => $meta->transformArray($client->metas)];
    }
}
