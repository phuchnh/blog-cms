<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClientRequest;
use App\Http\Requests\API\UpdateClientRequest;
use App\Models\Client;

class ClientController extends ApiBaseController
{
    public function index(Client $clients)
    {
        return $this->ok($clients->with('media')
                               ->orderBy('id', 'desc')->get());
    }

    public function show(Client $client)
    {
        if ($client->media()->count() > 0) {
            $client->thumbnail = $client->media()->thumbnailUrl();
        } else {
            $client->thumbnail = null;
        }

        return $this->ok($client->load('media'));
    }

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

    public function update(Client $client, UpdateClientRequest $request)
    {
        $client->fill($request->validated());
        $client->save();

        if (is_array($thumbnail = $request->get('thumbnail'))) {
            $fileName = array_get($thumbnail, 'name');
            $fileContent = array_get($thumbnail, 'body');
            $client->addMediaFromBase64($fileContent)
                 ->usingFileName($fileName)
                 ->withCustomProperties(['thumbnail'])
                 ->toMediaCollection();
        }

        return $this->noContent();
    }

    public function destroy(Client $client)
    {
        if (!empty($client->media->all())) {
            $client->media->each->delete();
        }
        $client->delete();

        return $this->noContent();
    }
}
