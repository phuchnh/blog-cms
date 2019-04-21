<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;

class Taxonomy extends Model
{
    use NodeTrait,
        Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'taxonomies';

    /**
     * Array with the fields translated in the Translation table.
     *
     * @var array
     */

    public $translatedAttributes = ['title', 'slug', 'description'];

    /**
     * Default foreign key Translation table
     *
     * @var string
     */
    public $translationForeignKey = 'taxonomy_id';

    /**
     * Set default translation model
     *
     * @var string
     */
    public $translationModel = TaxonomyTranslation::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'parent_id',
    ];

    protected $hidden = [
        'left',
        'right',
        'parent_id',
    ];

    /**
     * Get posts belongs to taxonomies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)
                    ->using(PostTaxonomy::class)
                    ->withPivot(['order']);
    }

    public function getLftName()
    {
        return 'lft';
    }

    public function getRgtName()
    {
        return 'rgt';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }

    /**
     * @param $value
     * @throws \Exception
     */
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $locale
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfLocale($query, $locale)
    {
        $table = "SELECT taxonomy_translations.locale,
                       taxonomy_translations.title,
                       taxonomy_translations.slug,
                       taxonomy_translations.description,
                       taxonomies.*
                FROM taxonomies, taxonomy_translations
                WHERE taxonomies.id = taxonomy_translations.taxonomy_id
                AND taxonomy_translations.locale = '{$locale}'";

        return $query->from(DB::raw("({$table}) taxonomies"));
    }
}
