<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class ArrayHelper
 * @package App\Utils
 */
class ArrayHelper {

    /**
     * @param Model|Collection $model
     *
     * @return array
     */
    public static function camel_case($model) {
        $data = collect($model->toArray());
        return $data
            ->keyBy(function ($value, $key) {
                return camel_case($key);
            })
            ->toArray();
    }

    /**
     * @param Model|Collection $model
     *
     * @return mixed
     */
    public static function camel_case_recursive($model) {
        $data = $model;
        if (!is_array($model)) {
            $data = collect($model->toArray());
        }
        return static::key_by_recursive($data, function ($value, $key) {
            return camel_case($key);
        })->toArray();
    }

    /**
     * @param $data
     * @param $func
     *
     * @return Collection
     */
    private static function key_by_recursive($data, $func) {
        return collect($data)
            ->keyBy(function ($value, $key) use ($func) {
                return $func($value, $key);
            })
            ->map(function ($item) use ($func) {
                if ($item instanceof Collection) {
                    return static::key_by_recursive($item, $func);
                }
                if (is_array($item) || is_object($item)) {
                    return static::key_by_recursive($item, $func);
                }
                return $item;
            });
    }

}
