<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait HasModify
{
    // TODO: Add auth user
    public static $CREATED_BY = 'created_by';

    public static $UPDATED_BY = 'updated_by';

    public static $DELETED_BY = 'deleted_by';

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
                $model->{static::$CREATED_BY} = 0;
                $model->{static::$UPDATED_BY} = 0;
            }
        });
        static::updating(function ($model) {
            if (Schema::hasColumn($model->getTable(), static::$CREATED_BY) && Schema::hasColumn($model->getTable(), static::$UPDATED_BY)) {
                $model->{static::$CREATED_BY} = 0;
                $model->{static::$UPDATED_BY} = 0;
            }
        });
        static::deleting(function ($model) {
            if (Schema::hasColumn($model->getTable(), static::$DELETED_BY)) {
                $model->{static::$DELETED_BY} = 0;
            }
        });
    }
}
