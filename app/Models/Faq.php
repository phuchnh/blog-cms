<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Faq extends Post
{
    /**
     * The attributes can search
     *
     * @var array
     */
    protected $searchable = [
        'title',
        'slug',
        'description',
    ];

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
        $postType = self::POST_TYPE;

        $table = "SELECT post_translations.locale,
                       post_translations.title,
                       post_translations.slug,
                       post_translations.content,
                       post_translations.description,
                       posts.*
                FROM posts,
                     post_translations
                WHERE posts.id = post_translations.post_id
                  AND posts.type = '{$postType}'
                  AND post_translations.deleted_at IS NULL
                  AND post_translations.locale = '{$locale}'";

        return $query->from(DB::raw("({$table}) posts"));
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $request)
    {
        if ($request->hasAny($this->searchable)) {
            $keys = array_keys($request->all());

            $values = array_reduce($keys, function ($result, $key) use ($request) {
                if (in_array($key, $this->searchable)) {
                    $result[$key] = $request->get($key);
                }

                return $result;
            }, []);

            $mode = $request->get('mode') ?: 'contain';

            foreach ($values as $key => $value) {
                $search = '%'.$value.'%';
                $operator = 'LIKE';

                if (Str::snake($mode) === 'starts_with') {
                    $search = $value.'%';
                }

                if (Str::snake($mode) === 'ends_with') {
                    $search = '%'.$value;
                }

                if (Str::snake($mode) === 'exactly') {
                    $operator = '=';
                    $search = $value;
                }

                $query = $query->where($key, $operator, "{$search}");
            }
        }

        return $query;
    }
}
