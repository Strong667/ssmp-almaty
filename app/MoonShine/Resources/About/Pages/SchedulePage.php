<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\CitizenSchedule;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Table\TableBuilder;

#[SkipMenu]
class SchedulePage extends Page
{

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
            ->orderBy('time_from')
            ->get();

        return [
            Box::make('График приёма граждан', [
                $schedules->isNotEmpty()
                    ? TableBuilder::make(
                        [
                            ID::make()->sortable(),
                            Text::make('ФИО', 'full_name'),
                            Text::make('Должность', 'position'),
                            Text::make('День', 'day'),
                            Text::make('Время', 'formatted_time'),
                        ],
                        $schedules
                    )
                    : Text::make('График приёма граждан пока не добавлен')
                        ->readonly(),
            ]),
        ];
    }
}

