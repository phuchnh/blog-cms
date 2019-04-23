<?php

namespace App\Http\Controllers\API;

use App\Models\Faq;
use App\Transformers\FaqTransformer;
use Illuminate\Http\Request;

class FaqController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Faq $faq)
    {
        if ($locale = $request->get('locale', config('app.locale'))) {
            $faq = $faq->ofLocale($locale);
        }

        if ($sort = $request->get('sort')) {
            $faq = $faq->sortable([
                $sort => $request->get('direction'),
            ]);
        }

        $items = $faq->get();

        if ($paginator = $request->get('perPage')) {
            $items = $faq->paginate($paginator);
        }

        return $this->ok($items, FaqTransformer::class);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Faq $faq)
    {
        return $this->ok($faq, FaqTransformer::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $faq = new Faq();

        $faq->fill($request->all());

        if ($translations = $request->get('translations')) {
            foreach ($translations as $translation) {
                if (! $translation['title']) {
                    continue;
                }
                $faq->translateOrNew($translation['locale'])->fill($translation);
            }
        }

        $faq->save();

        return $this->created($faq, FaqTransformer::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Faq $faq)
    {
        $faq->fill($request->all());

        if ($translations = $request->get('translations')) {
            foreach ($translations as $translation) {
                if (! $translation['title']) {
                    continue;
                }
                $faq->translateOrNew($translation['locale'])->fill($translation);
            }
        }

        $faq->save();

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return $this->noContent();
    }
}
