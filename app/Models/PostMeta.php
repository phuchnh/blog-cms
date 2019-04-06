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
        'post_id',
        'meta_key',
        'meta_value',
    ];

    /**
     * The attributes to validation
     *
     * @var array
     */
    public static $rules = [
        '*.post_id'    => 'required|integer',
        '*.meta_key'   => 'required|string',
        '*.meta_value' => 'required|string',
    ];
}
