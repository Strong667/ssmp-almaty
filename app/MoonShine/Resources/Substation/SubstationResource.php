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
            Text::make('Название', 'name')->sortable(),
            Text::make('Адрес', 'address')->sortable(),
            Text::make('Телефон', 'phone')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                Text::make('Название', 'name')
                    ->required()
                    ->placeholder('Например: Подстанция №1'),
                Text::make('Адрес', 'address')
                    ->required()
                    ->placeholder('Например: ул. Толстого, 6А'),
                Text::make('Телефон', 'phone')
                    ->required()
                    ->placeholder('Например: +7 (727) 123-45-67'),
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
            Text::make('Название', 'name'),
            Text::make('Адрес', 'address'),
            Text::make('Телефон', 'phone'),
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
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}

