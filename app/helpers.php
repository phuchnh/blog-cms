<?php

if (! function_exists('array_collapse_recursive')) {
    function array_collapse_recursive($array)
    {
        $results = [];
        foreach ($array as $values) {
            if (! is_array($values)) {
                continue;
            } else {
                $values = \Illuminate\Support\Arr::collapse($values);
            }

            $results = array_merge($results, $values);
        }

        return $results;
    }
}