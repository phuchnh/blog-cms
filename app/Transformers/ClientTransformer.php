<?php

namespace App\Transformers;

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
     * @param \App\Models\Post $post
     * @return array
     */
    public function transform(\App\Models\Client $client)
    {
        return array_merge(
            $client->toArray(),
            $this->transformMedia($client),
        );
    }

    /**
     * transform media thumbnail
     *
     * @param \App\Models\Client $client
     * @return array
     */
    private function transformMedia(\App\Models\Client $client)
    {
        if ($client->media()->count() > 0) {
            $client->thumbnail = $client->media()->thumbnailUrl();
        } else {
            $client->thumbnail = null;
        }

        return ['thumbnail' => $client->thumbnail];
    }
}
