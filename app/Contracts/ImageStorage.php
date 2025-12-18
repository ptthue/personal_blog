<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface ImageStorage
{
    /**
     * Store an uploaded file and return its path.
     *
     * @param UploadedFile|null $file The uploaded file to store.
     * @param string $directory The directory where the file should be stored.
     * @param string $disk The disk to use for storage.
     * @return string|null The path of the stored file or null if no file was provided.
     */
    public function store(?UploadedFile $file, string $directory = 'uploads', string $disk = 'public'): ?string;

    public function delete(string $filename, string $directory = 'uploads', string $disk = 'public'): void;
}
