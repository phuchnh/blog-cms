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
        return array_merge(
            $user->toArray(),
            $this->transformMeta($user)
        );
    }

    /**
     * Transform meta array to one
     *
     * @param \App\Models\User $user
     * @return array
     */
    private function transformMeta(User $user)
    {
        $meta = new MetaTransformer();

        return ['meta' => $meta->transformArray($user->metas)];
    }
}
