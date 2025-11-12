<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\MissionValue;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;

#[SkipMenu]
class MissionPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Миссия и ценности';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/mission' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $missionValues = MissionValue::query()
            ->orderBy('title')
            ->get();

        return [
            Box::make('Миссия и ценности', [
                Heading::make('Миссия и ценности'),
                // Здесь можно добавить компоненты для отображения миссии и ценностей
            ]),
        ];
    }
}

