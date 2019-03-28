<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTaxonomy extends Pivot
{
    protected $table = 'post_taxonomy';

    protected $fillable = [
        'order'
    ];
}
