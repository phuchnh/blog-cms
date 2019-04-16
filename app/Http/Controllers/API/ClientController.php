<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClientRequest;
use App\Http\Requests\API\UpdateClientRequest;
use App\Models\Client;
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
        $paginator = $request->get('perPage');

        $clients = $clients
            ->when($request->input('name'), function ($query) use ($request) {
                /**@var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('name', 'LIKE', '%'.$request->input('name').'%');
            })
            ->sortable([$request->get('sort') => $request->get('direction')])
            ->orderBy('id', 'desc')->paginate($paginator);

        return $this->ok($clients);
    }

    /**
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Client $client)
    {
        if ($client->media()->count() > 0) {
            $client->thumbnail = $client->media()->thumbnailUrl();
        } else {
            $client->thumbnail = null;
        }

        return $this->ok($client->load('media'));
    }

    /**
     * @param \App\Http\Requests\API\CreateClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateClientRequest $request)
    {
        $client = Client::create($request->validated());

        if ($thumbnail = $request->get('thumbnail')) {
            $fileName = array_get($thumbnail, 'name');
            $fileContent = array_get($thumbnail, 'body');
            $client->addMediaFromBase64($fileContent)
                   ->usingFileName($fileName)
                   ->withCustomProperties(['thumbnail'])
                   ->toMediaCollection();
        }

        return $this->created($client);
    }

    /**
     * @param \App\Models\Client $client
     * @param \App\Http\Requests\API\UpdateClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\InvalidBase64Data
     */
    public function update(Client $client, UpdateClientRequest $request)
    {
        $client->fill($request->validated());
        $client->save();

        if (is_array($thumbnail = $request->get('thumbnail'))) {
            $fileName = array_get($thumbnail, 'name');
            $fileContent = array_get($thumbnail, 'body');
            $client->clearMediaCollection()
                   ->addMediaFromBase64($fileContent)
                   ->usingFileName($fileName)
                   ->withCustomProperties(['thumbnail'])
                   ->toMediaCollection();
        }

        return $this->noContent();
    }

    /**
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        if (! empty($client->media->all())) {
            $client->media->each->delete();
        }
        $client->delete();

        return $this->noContent();
    }
}
