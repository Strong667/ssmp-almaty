<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CitizenSchedule;

use App\Models\CitizenSchedule;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<CitizenSchedule>
 */
class CitizenScheduleResource extends ModelResource
{
    protected string $model = CitizenSchedule::class;

    protected string $title = 'График приёма граждан';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('ФИО', 'full_name'),
            Text::make('Должность', 'position'),
            Text::make('День', 'day'),
            Text::make('Время', 'time'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('ФИО', 'full_name')->required(),
                Text::make('Должность', 'position')->required(),
                Text::make('День', 'day')->required(),
                Text::make('Время', 'time')->required()->hint('Например: с 10.00 до 12.00'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('ФИО', 'full_name'),
            Text::make('Должность', 'position'),
            Text::make('День', 'day'),
            Text::make('Время', 'time'),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'day' => ['required', 'string', 'max:50'],
            'time' => ['required', 'string', 'max:50'],
        ];
    }
}
