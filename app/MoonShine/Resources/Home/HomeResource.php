<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Home;

use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Resources\Home\Pages\HomePage;
use App\Models\Setting;

class HomeResource extends ModelResource
{
    protected string $model = Setting::class; // Используем Setting как заглушку для модели
    protected string $title = 'Главная';

    /**
     * Используем GuestLayout для публичных страниц
     */
    protected function getLayout(): string
    {
        return \App\MoonShine\Layouts\GuestLayout::class;
    }

    /**
     * @return list<class-string<\MoonShine\Contracts\Core\PageContract>>
     */
    protected function pages(): array
    {
        return [
            HomePage::class,
        ];
    }
}

