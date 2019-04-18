<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use App\Transformers\PostTransformer;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
}
