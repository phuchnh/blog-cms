<?php

namespace App\Transformers;

use App\Models\Option;
use Flugg\Responder\Transformers\Transformer;

class OptionTransformer extends Transformer
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
     * @param $options
     * @return array @mix
     */
    public function transformArray($options)
    {
        $result = [];
        foreach ($options as $option) {
            $result[$option->option_name] = $option->option_value;
        }

        return $result;
    }
}
