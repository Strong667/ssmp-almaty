<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Services\Storage\PublicStorageService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PublicStorageController extends Controller
{
    public function __construct(private readonly PublicStorageService $storage)
    {
    }

    public function __invoke(string $path): StreamedResponse
    {
        return $this->storage->stream($path);
    }
}

