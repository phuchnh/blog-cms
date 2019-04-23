<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMetaRequest;
use App\Http\Requests\API\UpdateMetaRequest;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class MetaController extends ApiBaseController
{
    protected $model;

    protected $modelId;


    public function __construct()
    {
        $this->model = Relation::getMorphedModel(
            request()->route()->parameter('model')
        );

        $this->model = new $this->model();

        $this->modelId = request()->route()->parameter('modelId');
        $this->model = $this->model->findOrFail($this->modelId);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->ok($this->model->metas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\CreateMetaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMetaRequest $request)
    {
        $meta = $this->model->metas()->createMany($request->validated());

        return $this->created($meta);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $metaId = request('metum');
        $meta = $this->model->metas()->findOrFail($metaId);

        return $this->ok($meta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\API\UpdateMetaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMetaRequest $request)
    {
        $metaId = request('metum');
        $meta = $this->model->metas()->findOrFail($metaId);
        $meta->fill($request->validated());
        $meta->save();

        return $this->noContent();
    }

    /**
     * update Many Meta Data
     *
     * @param \App\Http\Requests\API\UpdateMetaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMany(UpdateMetaRequest $request)
    {
        $inputArray = $request->validated();
        foreach ($inputArray as $item) {
            if ($item['meta_value']) {
                $this->model->metas()->updateOrCreate(['meta_key' => $item['meta_key']], $item);
            }
        }

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $metaId = request('metum');
        $meta = $this->model->metas()->findOrFail($metaId);
        $meta->delete();

        return $this->noContent();
    }
}
