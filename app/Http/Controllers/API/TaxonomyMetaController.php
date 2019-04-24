<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMetaRequest;
use App\Http\Requests\API\UpdateMetaRequest;
use App\Models\Meta;
use Illuminate\Http\Request;
use App\Models\Taxonomy;
use Illuminate\Support\Arr;

class TaxonomyMetaController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Taxonomy $taxomomy
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Taxonomy $taxomomy)
    {
        $metas = $taxomomy->metas
            ->map(function ($value) {
                return [$value->meta_key => $value->meta_value];
            })
            ->collapse()
            ->toArray();

        return $this->ok(['metas' => $metas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\CreateMetaRequest $request
     * @param \App\Models\Taxonomy $taxomomy
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMetaRequest $request, Taxonomy $taxomomy)
    {
        $metas = $this->updateOrCreateMeta($taxomomy, $request->validated());

        return $this->created($metas);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Taxonomy $taxonomy
     * @param \App\Models\Meta $metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Taxonomy $taxonomy, Meta $metum)
    {
        return $this->ok($metum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\API\UpdateMetaRequest $request
     * @param \App\Models\Taxonomy $taxonomy
     * @param \App\Models\Meta $metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMetaRequest $request, Taxonomy $taxonomy, Meta $metum)
    {
        $metum->fill($request->all());
        $taxonomy->metas()->save($metum);

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Taxonomy $taxomomy
     * @param \App\Models\Meta $metum
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Taxonomy $taxomomy, Meta $metum)
    {
        $metum->delete();

        return $this->noContent();
    }

    /**
     * Update or create meta values
     *
     * @param \App\Models\Taxonomy $taxomomy
     * @param array $metas
     * @return array
     */
    private function updateOrCreateMeta(Taxonomy $taxomomy, array $metas)
    {
        $models = [];
        $metas = Arr::get($metas, 'metas');
        foreach ($metas as $meta) {
            $models[] = $taxomomy->metas()->updateOrCreate(['meta_key' => $meta['meta_key']], $meta);
        }

        return $models;
    }
}
