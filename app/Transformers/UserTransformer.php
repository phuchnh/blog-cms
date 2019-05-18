<?php

namespace App\Transformers;

use App\Models\User;
use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer
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
     * @param \App\Models\User $user
     * @return array
     */
    public function transform(User $user)
    {
        $metas = $user->metas
            ->map(function ($value) {
                return [$value->meta_key => $value->meta_value];
            })
            ->collapse()
            ->toArray();

        $user->makeHidden('metas');
        $result = $user->toArray();

        $result['meta'] = $metas;

        return $result;
    }
}
