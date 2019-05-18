<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMetaRequest;
use App\Http\Requests\API\UpdateMetaRequest;
use App\Models\Client;
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ClientMetaController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Client $client)
    {
        $metas = $client->metas
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
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMetaRequest $request, Client $client)
    {
        $metas = $this->updateOrCreateMeta($client, $request->validated());

        return $this->created($metas);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @param \App\Models\Meta $metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Client $client, Meta $metum)
    {
        return $this->ok($metum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\API\UpdateMetaRequest $request
     * @param \App\Models\Client $client
     * @param \App\Models\Meta $metum
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMetaRequest $request, Client $client, Meta $metum)
    {
        $metum->fill($request->all());
        $client->metas()->save($metum);

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @param \App\Models\Meta $metum
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Client $client, Meta $metum)
    {
        $metum->delete();

        return $this->noContent();
    }

    /**
     * Update or create meta values
     *
     * @param \App\Models\Client $client
     * @param array $metas
     * @return array
     */
    private function updateOrCreateMeta(Client $client, array $metas)
    {
        $models = [];
        $metas = Arr::get($metas, 'metas');
        foreach ($metas as $meta) {
            $models[] = $client->metas()->updateOrCreate(['meta_key' => $meta['meta_key']], $meta);
        }

        return $models;
    }
}
