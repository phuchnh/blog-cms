<?php

namespace App\Http\Controllers\API;

use App\Models\Asset;
use App\Transformers\AssetTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AssetController extends ApiBaseController
{
    protected $path;

    public function __construct()
    {
        $userId = optional(auth('api')->user())->id ?: 'default';
        $this->path = join('/', ['uploads', $userId, now()->timestamp]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Asset $assets
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Asset $assets)
    {
        $assets = $assets->whereCreatedBy($request->user()->id)->get();

        return $this->ok($assets, AssetTransformer::class);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Asset $asset
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Asset $asset)
    {
        return $this->ok($asset, PostTransformer::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $models = $this->upload($request);

        return $this->ok($models, AssetTransformer::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Asset $asset
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Asset $asset)
    {
        $asset->delete();

        return $this->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $models = collect([]);

        if ($files = $request->file('files')) {

            if (! is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                if ($file instanceof UploadedFile) {

                    /**
                     * @var $asset \App\Models\Asset
                     */
                    $asset = $this->fillAssetModel($file);

                    if ($path = $this->getPathUpload($file)) {

                        $asset->path = $path;
                        $asset->uri = url(Storage::url($asset->path));

                        $asset->save();
                        $models->push($asset);
                    }
                }
            }
        }

        return $models;
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @return bool|false|string
     */
    private function getPathUpload(UploadedFile $file)
    {
        if ($path = $file->storeAs($this->path, $file->getClientOriginalName(), 'public')) {
            return $path;
        }

        return false;
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @return \App\Models\Asset
     */
    private function fillAssetModel(UploadedFile $file)
    {
        $asset = new Asset();
        $asset->name = $file->getClientOriginalName();
        $asset->mime = $file->getClientMimeType();
        $asset->size = $file->getSize();

        return $asset;
    }
}
