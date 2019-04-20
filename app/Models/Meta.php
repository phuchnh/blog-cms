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
     * The attributes to validation
     *
     * @var array
     */
    public static $rules = [
        '*.meta_key'   => 'required|string',
        '*.meta_value' => 'string|nullable',
    ];

    /**
     * Get all of the owning meta models.
     */
    public function metable()
    {
        return $this->morphTo();
    }
}
