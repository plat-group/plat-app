<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid;

trait UuidTrait
{

    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->generateUuid($model);
        });
    }

    public function getIncrementing()
    {
        return false;
    }

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
