<?php

namespace App\Transformers;

use App\Models\Asset;
use Flugg\Responder\Transformers\Transformer;
use Illuminate\Support\Facades\Storage;

class AssetTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param \App\Models\Asset $asset
     * @return array
     */
    public function transform(Asset $asset)
    {
        $link = Storage::url($asset->path);

        return [
            'id'        => (int) $asset->id,
            'file_name' => (string) $asset->file_name,
            'mime_type' => (string) $asset->mime_type,
            'path'      => (string) $asset->path,
            'size'      => (int) $asset->size,
            'url'       => (string) url($link),
        ];
    }
}
