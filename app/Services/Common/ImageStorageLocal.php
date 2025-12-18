<?php

namespace App\Services\Common;

use App\Contracts\ImageStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageStorageLocal implements ImageStorage
{
    /**
     * Store an uploaded file and return its path.
     *
     * @param UploadedFile|null $file The uploaded file to store.
     * @param string $directory The directory where the file should be stored.
     * @param string $disk The disk to use for storage.
     * @return string|null The path of the stored file or null if no file was provided.
     */
    public function store(?UploadedFile $file, string $directory = 'uploads', string $disk = 'public'): ?string
    {
        if (!$file) return null;

        $filename = time() . '_' . $file->hashName();

        $file->storeAs($directory, $filename, $disk);

        return $filename;
    }

    public function delete(string $filename, string $directory = 'uploads', string $disk = 'public'): void
    {
        Storage::disk($disk)->delete($directory . '/' . $filename);
    }
}
