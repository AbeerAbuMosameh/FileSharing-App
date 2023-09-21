<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Storage;

trait fileTrait
{
    public function storefile($file)
    {
        $fileName = time() . $file->getClientOriginalName();
        Storage::disk('public')->put($fileName, file_get_contents($file));
        return 'storage/' . $fileName;
    }


}
