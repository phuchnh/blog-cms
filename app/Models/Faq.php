<?php

namespace App\Models;

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
     * @var string
     */
    public const DEFAULT_TYPE = 'post_faq';


    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'type' => self::DEFAULT_TYPE
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            /**
             * @var $query \Illuminate\Database\Eloquent\Builder
             */
            $query->where('type', self::DEFAULT_TYPE);
        });
    }
}
