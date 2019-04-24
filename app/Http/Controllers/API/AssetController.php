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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $assets = Asset::whereCreatedBy((auth('api')->user())->id)->get();

        return $this->ok($assets, AssetTransformer::class);
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

        return $this->ok($models, AssetTransformer::class);
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
