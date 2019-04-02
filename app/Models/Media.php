<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\Models\Media as BaseMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends BaseMedia
{
    use SoftDeletes;

    /**
     * @param Builder $query
     * @return string
     */
    public function scopeThumbnailUrl(Builder $query)
    {
        return $query->get()->filter(function ($item) {
            return implode('|', $item->custom_properties) == 'thumbnail';
        })->last()->getFullUrl();
    }
}
