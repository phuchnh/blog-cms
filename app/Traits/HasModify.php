<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait HasModify
{
    // TODO: Add auth user
    public static $CREATED_BY = 'created_by';

    public static $UPDATED_BY = 'updated_by';

    public static $DELETED_BY = 'deleted_by';

    private static function currentUser()
    {
        return optional(auth('api')->user())->id ?? 0;
    }

    /**
     * Register the model events for updating the user audit trails.
     */
    public static function bootHasModify()
    {
        static::creating(function ($model) {

            /**
             * @var $model \Illuminate\Database\Eloquent\Model
             */
            if (Schema::hasColumn($model->getTable(), static::$CREATED_BY) && Schema::hasColumn($model->getTable(), static::$UPDATED_BY)) {
                $model->{static::$CREATED_BY} = self::currentUser();
                $model->{static::$UPDATED_BY} = self::currentUser();
            }
        });
        static::updating(function ($model) {

            /**
             * @var $model \Illuminate\Database\Eloquent\Model
             */
            if (Schema::hasColumn($model->getTable(), static::$CREATED_BY) && Schema::hasColumn($model->getTable(), static::$UPDATED_BY)) {
                $model->{static::$CREATED_BY} = self::currentUser();
                $model->{static::$UPDATED_BY} = self::currentUser();
            }
        });
        static::deleting(function ($model) {

            /**
             * @var $model \Illuminate\Database\Eloquent\Model
             */
            if (Schema::hasColumn($model->getTable(), static::$DELETED_BY)) {
                $model->{static::$DELETED_BY} = self::currentUser();
            }
        });
    }
}
