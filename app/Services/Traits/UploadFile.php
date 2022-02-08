<?php

namespace App\Services\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFile {
    function uploadThumb($folder, $file)
    {
        return Storage::putFile($folder, $file);
    }
}