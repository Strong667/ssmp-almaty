<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\Structure;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;

#[SkipMenu]
class StructurePage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Структура';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/structure' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $structures = Structure::query()
            ->orderBy('title')
            ->get();

        return [
            Box::make('Структура', [
                Heading::make('Структура'),
                // Здесь можно добавить компоненты для отображения структуры
            ]),
        ];
    }
}

