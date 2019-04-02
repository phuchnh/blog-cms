<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaqRequest;
use App\Http\Requests\API\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Faq $faq)
    {
        return $this->ok($faq->with('media')->paginate());
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
        return $this->ok($faq->load('media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\CreateFaqRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateFaqRequest $request)
    {
        $post = Faq::create($request->validated());
        if ($thumbnail = $request->get('thumbnail')) {
            $post->addMediaFromBase64('thumbnail')->toMediaCollection();
        }

        return $this->created($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\API\UpdateFaqRequest $request
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $faq->fill($request->validated());
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
