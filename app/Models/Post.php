<?php

namespace App\Models;

use App\Traits\HasModify;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers, HasModify, HasMediaTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tilte',
        'description',
        'content',
        'publish',
        'slug',
        'thumbnail',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'type' => 'post'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes to validation
     *
     * @var array
     */
    public static $rules = [
        'tilte'       => 'required|string',
        'description' => 'nullable|string',
        'content'     => 'nullable|string',
        'slug'        => 'nullable|string',
        'publish'     => 'nullable|boolean',
        'thumbnail'   => 'nullable|string',
    ];

    /**
     * Get post meta belongs to this post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postMeta()
    {
        return $this->hasMany(PostMeta::class, 'post_id');
    }

    /**
     * Get taxonomies belongs to this post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxonomies()
    {
        return $this->belongsToMany(Taxonomy::class)
                    ->using(PostTaxonomy::class)
                    ->withPivot(['order']);
    }
}
