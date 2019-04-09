<?php

namespace App\Transformers;

use App\Models\Taxonomy;
use Flugg\Responder\Transformers\Transformer;

class TaxonomyTransformer extends Transformer
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
     * @param $taxonomies
     * @return array
     */
    public function transform($taxonomies)
    {
        $result = [];
        foreach ($taxonomies as $taxonomy) {
            array_push($result, $taxonomy->name);
        }

        return $result;
    }

}
