<?php

namespace App\Transformers;

use App\Models\Subscription;
use Flugg\Responder\Transformers\Transformer;

class SubscriptionTransformer extends Transformer
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
     * @param  \App\Models\Subscription $subscription
     * @return array
     */
    public function transform(Subscription $subscription)
    {
        $data = $subscription->toArray();
        $data['content'] = json_decode($data['content']);

        return $data;
    }
}
