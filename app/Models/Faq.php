<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Faq extends Post
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Default post type
     *
     * @var string
     */
    public const POST_TYPE = 'post_faq';

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'type' => self::POST_TYPE,
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            /**
             * @var $query \Illuminate\Database\Eloquent\Builder
             */
            $query->where('type', self::POST_TYPE);
        });
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $locale
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfLocale($query, $locale)
    {
        return $query
            ->join(PostTranslation::getTable(), function ($join) use ($locale) {
                /**@var $join \Illuminate\Database\Query\JoinClause */
                $join->on(function ($query) use ($locale) {
                    $sql = DB::raw("posts.id = post_translations.post_id AND post_translations.deleted_at IS NULL AND post_translations.locale = '$locale'");
                    /**@var $query \Illuminate\Database\Query\Builder */
                    $query->whereRaw(DB::raw($sql));
                });
            })
            ->addSelect([
                'posts.*',
                'post_translations.locale',
                'post_translations.title',
                'post_translations.slug',
                'post_translations.content',
                'post_translations.description',
            ]);
    }
}
