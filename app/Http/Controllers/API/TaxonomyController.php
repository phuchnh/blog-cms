<?php

namespace App\Http\Controllers\API;

use App\Models\Taxonomy;
use Illuminate\Http\Request;

class TaxonomyController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Taxonomy $taxonomies
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Taxonomy $taxonomies)
    {
        if ($type = $request->get('type')) {
            $taxonomies = $taxonomies->where('type', $type);
        }

        if ($paginator = $request->get('perPage')) {
            $taxonomies = $taxonomies->paginate($paginator);
        }

        $taxonomies = $taxonomies->get();

        return $this->ok($taxonomies);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Taxonomy $taxonomy
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Taxonomy $taxonomy)
    {
        return $this->ok($taxonomy);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $taxonomy = Taxonomy::create($request->all());

        return $this->created($taxonomy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Taxonomy $taxonomy
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Taxonomy $taxonomy)
    {
        $taxonomy->fill($request->all());
        $taxonomy->save();

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Taxonomy $taxonomy
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Taxonomy $taxonomy)
    {
        $taxonomy->delete();

        return $this->noContent();
    }
}
