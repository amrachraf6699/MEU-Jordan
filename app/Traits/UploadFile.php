<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    public function uploadFile($file)
    {
        $fileName = \Str::uuid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('uploads', $fileName, 'public');

        return 'uploads/'.$fileName;
    }

    public function deleteFile($path)
    {
        Storage::disk('public')->delete($path);
    }
}
