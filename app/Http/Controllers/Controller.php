<?php

namespace App\Http\Controllers;

use App\Transformers\OptionTransformer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Transformers\PostTransformer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * OptionController constructor.
     */
    public function __construct()
    {
        View::share('options', $this->getSettingInformation());
    }

    /**
     * transform data for post
     *
     * @param \Illuminate\Support\Collection $collection
     * @return \Illuminate\Support\Collection
     */
    public function loadTransformData($collection, $transformerClass = PostTransformer::class)
    {
        $data = responder()
            ->success($collection, $transformerClass)
            ->toCollection();

        return $data['data'] ? $data['data'] : null;
    }

    public function getSettingInformation()
    {
        if (Cache::has('siteOption_Setting')) {
            return Cache::get('siteOption_Setting');
        } else {
            $options = \App\Models\Option::get();
            $optionsTransform = new OptionTransformer();

            $data = $optionsTransform->transformArray($options);

            Cache::put('siteOption_Setting', $data, 60);

            return $data;
        }
    }
}
