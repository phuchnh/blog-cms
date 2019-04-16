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
     * Array with the fields translated in the Translation table.
     *
     * @var array
     */
    public $translatedAttributes = ['title', 'slug', 'content'];

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
