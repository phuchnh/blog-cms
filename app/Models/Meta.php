<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'metas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meta_key',
        'meta_value',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta_key'   => 'string',
        'meta_value' => 'array',
    ];

    /**
     * The attributes to validation
     *
     * @var array
     */
    public static $rules = [
        'metas'              => 'required|array',
        'metas.*.meta_key'   => 'required|string',
        'metas.*.meta_value' => 'present',
    ];

    /**
     * Get all of the owning meta models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function metable()
    {
        return $this->morphTo();
    }
}
