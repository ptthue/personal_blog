<?php

namespace App\Contracts;

use App\ENum\ImageType;
use Illuminate\Http\UploadedFile;

interface ImageStorage
{
    /**
     * Store an uploaded file and return its filename.
     *
     * @param UploadedFile $file The uploaded file to store.
     * @param ImageType $type The type of image being stored.
     * @return string|null The filename of the stored file or null if no file was provided.
     */
    public function store(UploadedFile $file, ImageType $type): ?string;

    /**
     * Delete a file by its filename and type.
     *
     * @param string $filename The filename of the file to delete.
     * @param ImageType $type The type of image being deleted.
     */
    public function delete(string $filename, ImageType $type): void;
}
