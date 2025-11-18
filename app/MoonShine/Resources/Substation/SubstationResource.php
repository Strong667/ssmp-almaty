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
            Text::make('Название (русский)', 'name')->sortable(),
            Text::make('Название (казахский)', 'name_kk'),
            Text::make('Адрес (русский)', 'address')->sortable(),
            Text::make('Адрес (казахский)', 'address_kk'),
            Text::make('Телефон', 'phone')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация (русский)', [
                Text::make('Название (русский)', 'name')
                    ->required()
                    ->placeholder('Например: Подстанция №1'),
                Text::make('Адрес (русский)', 'address')
                    ->required()
                    ->placeholder('Например: ул. Толстого, 6А'),
                Text::make('Телефон', 'phone')
                    ->required()
                    ->placeholder('Например: +7 (727) 123-45-67'),
            ]),
            Box::make('Основная информация (казахский)', [
                Text::make('Название (казахский)', 'name_kk')
                    ->placeholder('Мысалы: Бекет №1'),
                Text::make('Адрес (казахский)', 'address_kk')
                    ->placeholder('Мысалы: Толстой көшесі, 6А'),
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
            Text::make('Название (русский)', 'name'),
            Text::make('Название (казахский)', 'name_kk'),
            Text::make('Адрес (русский)', 'address'),
            Text::make('Адрес (казахский)', 'address_kk'),
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
            'name_kk' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'address_kk' => ['nullable', 'string'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}

