<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_meta';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meta_key',
        'meta_value',
    ];

    protected $casts = [
        'meta_key'   => 'array',
        'meta_value' => 'array',
    ];

    /**
     * The attributes to validation
     *
     * @var array
     */
    public static $rules = [
        'metas'              => 'array',
        'metas.*.meta_key'   => 'required|string',
        'metas.*.meta_value' => 'required',
    ];
}
