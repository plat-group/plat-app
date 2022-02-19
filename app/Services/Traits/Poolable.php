<?php

namespace App\Services\Traits;

trait Poolable
{
    /**
     * Push record on the pool
     *
     * @param string $id
     */
    public function pushToPool($id)
    {
        // Get record and check exits
        $record = $this->repository->find($id);

        $record->status = ON_POOL_STATUS;
        $record->save();

        return $record;
    }
}
