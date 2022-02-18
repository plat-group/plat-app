<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid;

trait UuidTrait
{

    /**
     * Boot the Model.
     */
    public static function bootUuidTrait()
    {
        //parent::boot();

        static::creating(function ($model) {
            $model->generateUuid($model);
        });
    }

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @return false
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * The data type of the auto-incrementing ID.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    private function generateUuid($model)
    {
        if ($model->incrementing && !$model->getKey()) {
            $model->{$model->getKeyName()} = (string) Uuid::uuid6();
        }
    }
}
