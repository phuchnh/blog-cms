<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Str;

class Client extends Model
{
    use SoftDeletes, Sortable;

    /**
     * The attributes can search
     *
     * @var array
     */
    protected $searchable = [
        'name',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
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
        'name' => 'required|string',
        'url' => 'required|string',
    ];

    /**
     * Get post meta belongs to this client
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function metas()
    {
        return $this->morphMany(Meta::class, 'metable');
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
