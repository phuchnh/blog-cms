<?php

namespace App\Models;

use App\Traits\HasModify;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers, HasModify, HasMediaTrait, Sortable;

    /**
     * @var array
     */
    public $sortable = [
        'id',
        'title',
        'description',
        'content',
        'publish',
        'slug',
        'created_at',
        'updated_at',
    ];

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
        'title',
        'description',
        'content',
        'publish',
        'slug',
        'type',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [];

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
        'title'       => 'required|string',
        'type'        => 'required|string',
        'description' => 'nullable|string',
        'content'     => 'nullable|string',
        'slug'        => 'nullable|string',
        'publish'     => 'nullable|boolean',
    ];

    /**
     * Get post meta belongs to this post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meta()
    {
        return $this->hasMany(PostMeta::class, 'post_id');
    }

    /**
     * Get taxonomies belongs to this post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxonomies()
    {
        return $this->belongsToMany(Taxonomy::class)
                    ->using(PostTaxonomy::class)
                    ->withPivot(['order']);
    }
}
