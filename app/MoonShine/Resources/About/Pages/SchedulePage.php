<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\CitizenSchedule;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;

#[SkipMenu]
class SchedulePage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'График приёма граждан';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/schedule' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $schedules = CitizenSchedule::query()
            ->orderBy('day')
            ->orderBy('time')
            ->get();

        return [
            Box::make('График приёма граждан', [
                Heading::make('График приёма граждан'),
                // Здесь можно добавить компоненты для отображения графика
            ]),
        ];
    }
}

