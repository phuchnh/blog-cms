<?php

namespace App\Models;

use App\Traits\HasModify;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use SoftDeletes,
        HasModify,
        Sortable,
        Translatable;

    /**
     * @var array
     */
    public $sortable = ['id', 'title', 'content', 'publish', 'slug', 'created_at', 'updated_at'];

    /**
     * Custom sort title
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function titleSortable($query, $direction)
    {
        return $query->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
                     ->orderBy('title', $direction)
                     ->select('posts.*');
    }

    /**
     * Custom sort content
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function contentSortable($query, $direction)
    {
        return $query->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
                     ->orderBy('content', $direction)
                     ->select('posts.*');
    }

    /**
     * Custom sort slug
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function slugSortable($query, $direction)
    {
        return $query->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
                     ->orderBy('slug', $direction)
                     ->select('posts.*');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Array with the fields translated in the Translation table.
     *
     * @var array
     */
    public $translatedAttributes = ['title', 'slug', 'description', 'content'];

    /**
     * Default foreign key Translation table
     *
     * @var string
     */
    public $translationForeignKey = 'post_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'publish',
        'type',
    ];

    /**
     * Set default translation model
     *
     * @var string
     */
    public $translationModel = PostTranslation::class;

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
        'type'    => 'required|string',
        'publish' => 'nullable|boolean',
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
        return $this->belongsToMany(Taxonomy::class)->using(PostTaxonomy::class)->withPivot(['order']);
    }
}
