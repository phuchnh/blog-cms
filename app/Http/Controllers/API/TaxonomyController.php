<?php

namespace App\Http\Controllers\API;

use App\Models\Taxonomy;
use App\Transformers\TaxonomyTransformer;
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
        Taxonomy::disableAutoloadTranslations();

        if ($locale = $request->get('locale', config('app.locale'))) {
            $taxonomies = $taxonomies->ofLocale($locale);
        }

        if ($type = $request->get('type')) {
            $taxonomies = $taxonomies->where('type', $type);
        }

        $items = $taxonomies->get();
        if ($paginator = $request->get('perPage')) {
            $items = $taxonomies->paginate($paginator);
        }

        return $this->ok($items);
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
        return $this->ok($taxonomy, TaxonomyTransformer::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $taxonomy = new Taxonomy();

        $taxonomy->fill($request->all());

        if ($translations = $request->get('translations')) {
            foreach ($translations as $translation) {
                $taxonomy->translateOrNew($translation['locale'])->fill($translation);
            }
        }

        $taxonomy->save();

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

        if ($translations = $request->get('translations')) {
            foreach ($translations as $translation) {
                $taxonomy->translateOrNew($translation['locale'])->fill($translation);
            }
        }

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
