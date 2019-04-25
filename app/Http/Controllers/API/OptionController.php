<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOptionRequest;
use App\Models\Option;
use App\Transformers\OptionTransformer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OptionController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Option $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Option $options)
    {
        $options = $options->get();

        $optionsTransform  = new OptionTransformer();

        return $this->ok($optionsTransform->transformArray($options));
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Option $option
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Option $option)
    {
        return $this->ok($option);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\CreateOptionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOptionRequest $request)
    {
        foreach($request->validated() as $item) {
            Option::updateOrCreate(['option_name' => $item['option_name']], $item);
        }
        //Option::insert($request->validated());

        Cache::delete('siteOptionSetting');

        return $this->noContent();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Option $option
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Option $option)
    {
        $option->fill($request->all());
        $option->save();

        Cache::delete('siteOptionSetting');

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Option $option
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return $this->noContent();
    }
}
