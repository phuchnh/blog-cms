<?php

namespace App\Models;

use App\Interfaces\TaxonomyInterface;
use Franzose\ClosureTable\Models\Entity;

class Taxonomy extends Entity implements TaxonomyInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'taxonomies';

    /**
     * Hierarchy model instance.
     *
     * @var \App\Models\Hierarchy
     */
    protected $closure = Hierarchy::class;


    /**
     * Get posts belongs to taxonomies
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)
                    ->using(PostTaxonomy::class)
                    ->withPivot(['order']);
    }
}
