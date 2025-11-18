<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CitizenSchedule;

use App\Models\CitizenSchedule;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Select;

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
            Text::make('Должность (каз)', 'position_kk'),
            Text::make('День', 'day')->sortable(),
            Text::make('Время', 'formatted_time'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('ФИО', 'full_name')->required(),
                Text::make('Должность', 'position')->required(),
                Text::make('Должность (казахский)', 'position_kk'),
                Select::make('День недели', 'day')
                    ->required()
                    ->options([
                        'monday' => 'Понедельник',
                        'tuesday' => 'Вторник',
                        'wednesday' => 'Среда',
                        'thursday' => 'Четверг',
                        'friday' => 'Пятница',
                        'saturday' => 'Суббота',
                        'sunday' => 'Воскресенье',
                    ]),
                Text::make('Время с', 'time_from')
                    ->required()
                    ->customAttributes(['type' => 'time'])
                    ->hint('Начало приёма, например: 10:00'),
                Text::make('Время до', 'time_to')
                    ->required()
                    ->customAttributes(['type' => 'time'])
                    ->hint('Окончание приёма, например: 12:00'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('ФИО', 'full_name'),
            Text::make('Должность', 'position'),
            Text::make('Должность (казахский)', 'position_kk'),
            Text::make('День недели', 'day'),
            Text::make('Время с', 'time_from'),
            Text::make('Время до', 'time_to'),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'position_kk' => ['nullable', 'string', 'max:255'],
            'day' => ['required', 'string', 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday'],
            'time_from' => ['required', 'date_format:H:i'],
            'time_to' => ['required', 'date_format:H:i'],
        ];
    }
}
