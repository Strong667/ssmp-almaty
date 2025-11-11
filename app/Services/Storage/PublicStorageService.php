<?php

namespace App\Services\Storage;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PublicStorageService
{
    private FilesystemAdapter $disk;

    public function __construct()
    {
        $this->disk = Storage::disk('public');
    }

    public function stream(string $path): StreamedResponse
    {
        if (! $this->disk->exists($path)) {
            abort(404);
        }

        return $this->disk->response($path);
    }
}

