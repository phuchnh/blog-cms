<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostRequest;
use App\Http\Requests\API\UpdatePostRequest;
use App\Models\Option;
use App\Models\Post;
use App\Models\Taxonomy;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;

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

        return $this->ok($options);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $option = Option::create($request->all());

        return $this->created($option);
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
