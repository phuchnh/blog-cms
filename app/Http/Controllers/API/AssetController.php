<?php

namespace App\Http\Controllers\API;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends ApiBaseController
{
    protected $path;

    public function __construct()
    {
        $this->path = join('/', ['upload', auth('api')->user()->id]);
    }

    public function show()
    {

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
                if ($file instanceof \Illuminate\Http\UploadedFile) {

                    $asset = $this->fillAssetModel($file);

                    if ($path = $this->getPathUpload($file)) {
                        $asset->path = $path;
                        $asset->save();
                        $models->push($asset);
                    }
                }
            }
        }

        return $this->ok($models);
    }

    private function getPathUpload(\Illuminate\Http\UploadedFile $file)
    {
        $userId = auth('api')->user()->id ?: 0;

        if ($path = $file->storeAs(join('/', ['uploads', $userId]), $file->getClientOriginalName(), 'public')) {
            return $path;
        }

        return false;
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @return \App\Models\Asset
     */
    private function fillAssetModel(\Illuminate\Http\UploadedFile $file)
    {
        $asset = new \App\Models\Asset();
        $asset->file_name = $file->getClientOriginalName();
        $asset->mime_type = $file->getClientMimeType();
        $asset->size = $file->getSize();

        return $asset;
    }
}
