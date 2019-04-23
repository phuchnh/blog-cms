<?php

namespace App\Models;

use App\Traits\HasModify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasModify, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'uri',
        'name',
        'mime',
        'size',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'path' => 'string',
        'uri'  => 'string',
        'name' => 'string',
        'mime' => 'string',
        'size' => 'digits',
    ];
}
