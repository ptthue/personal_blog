<?php

namespace App\Infrastructure;

use App\Contracts\ImageStorage;
use App\ENum\ImageType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ConfigurableImageUploader implements ImageStorage
{

    /**
     * @inheritDoc
     */
    public function store(UploadedFile $file, ImageType $type): ?string
    {
        $config = config('image.' . $type->value);

        $disk = $config['disk'] ?? 'public';
        $directory = $config['directory'] ?? 'uploads/' . $type->value;

        $filename = time() . '_' . $file->hashName();

        $file->storeAs($directory, $filename, $disk);

        return $filename;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $filename, ImageType $type): void
    {
        $config = config('image.' . $type->value);

        $disk = $config['disk'] ?? 'public';
        $directory = $config['directory'] ?? 'uploads/' . $type->value;

        Storage::disk($disk)->delete($directory . '/' . $filename);
    }
}
