<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Str;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable, Sortable;

    /**
     * The attributes can search
     *
     * @var array
     */
    protected $searchable = [
        'name',
        'type',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
