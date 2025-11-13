<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Substation;

use App\Models\Substation;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Substation>
 */
class SubstationResource extends ModelResource
{
    protected string $model = Substation::class;

    protected string $title = 'Подстанции';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Number::make('Номер', 'number')->sortable(),
            Text::make('Адрес', 'address')->sortable(),
            Number::make('Бригад', 'brigades_count'),
            Number::make('Врачей', 'doctors_count'),
            Number::make('Фельдшеров', 'paramedics_count'),
            Number::make('Младший персонал', 'junior_staff_count'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                Number::make('Номер подстанции', 'number')
                    ->required()
                    ->min(1)
                    ->max(12)
                    ->placeholder('Номер от 1 до 12'),
                Text::make('Адрес', 'address')
                    ->required()
                    ->placeholder('Например: ул. Толстого, 6А'),
                Number::make('Количество бригад', 'brigades_count')
                    ->required()
                    ->min(0)
                    ->default(0),
                Number::make('Количество врачей', 'doctors_count')
                    ->required()
                    ->min(0)
                    ->default(0),
                Number::make('Количество фельдшеров', 'paramedics_count')
                    ->required()
                    ->min(0)
                    ->default(0),
                Number::make('Младший персонал', 'junior_staff_count')
                    ->required()
                    ->min(0)
                    ->default(0),
            ]),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Number::make('Номер подстанции', 'number'),
            Text::make('Адрес', 'address'),
            Number::make('Количество бригад', 'brigades_count'),
            Number::make('Количество врачей', 'doctors_count'),
            Number::make('Количество фельдшеров', 'paramedics_count'),
            Number::make('Младший персонал', 'junior_staff_count'),
        ];
    }

    /**
     * @param Substation $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'number' => ['required', 'integer', 'min:1', 'max:12', 'unique:substations,number,' . $item->id],
            'address' => ['required', 'string', 'max:255'],
            'brigades_count' => ['required', 'integer', 'min:0'],
            'doctors_count' => ['required', 'integer', 'min:0'],
            'paramedics_count' => ['required', 'integer', 'min:0'],
            'junior_staff_count' => ['required', 'integer', 'min:0'],
        ];
    }
}

