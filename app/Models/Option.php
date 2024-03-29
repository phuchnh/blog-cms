<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option_name',
        'option_value'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'option_name'   => 'string',
        'option_value' =>  'array',
    ];

    /**
     * The attributes to validation
     *
     * @var array
     */
    public static $rules = [
        '*.option_name'   => 'required|string',
        '*.option_value' => 'present',
    ];
}
