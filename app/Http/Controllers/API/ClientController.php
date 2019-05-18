<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClientRequest;
use App\Http\Requests\API\UpdateClientRequest;
use App\Models\Client;
use App\Transformers\ClientTransformer;
use Illuminate\Http\Request;

class ClientController extends ApiBaseController
{
    /**
     * @param \App\Models\Client $clients
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Client $clients, Request $request)
    {
        $clients = $clients->search($request);

        $paginator = $request->get('perPage');

        $clients = $clients
            ->sortable([$request->get('sort') => $request->get('direction')])
            ->orderBy('id', 'desc')->paginate($paginator);

        return $this->ok($clients, ClientTransformer::class);
    }

    /**
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Client $client)
    {
        return $this->ok($client, ClientTransformer::class);
    }

    /**
     * @param \App\Http\Requests\API\CreateClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateClientRequest $request)
    {
        $client = Client::create($request->validated());

        return $this->created($client);
    }

    /**
     * @param \App\Models\Client $client
     * @param \App\Http\Requests\API\UpdateClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Client $client, UpdateClientRequest $request)
    {
        $client->fill($request->validated());
        $client->save();

        return $this->noContent();
    }

    /**
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return $this->noContent();
    }
}
