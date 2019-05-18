<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTaxonomy extends Pivot
{
    /**
     * @var string
     */
    protected $table = 'post_taxonomy';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The name of the foreign key column.
     *
     * @var string
     */
    protected $foreignKey = 'post_id';

    /**
     * The name of the "other key" column.
     *
     * @var string
     */
    protected $relatedKey = 'taxonomy_id';

    /**
     * @var array
     */
    protected $fillable = [
        'order',
    ];
}
