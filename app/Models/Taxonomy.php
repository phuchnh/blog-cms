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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'parent_id',
        'position'
    ];


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
