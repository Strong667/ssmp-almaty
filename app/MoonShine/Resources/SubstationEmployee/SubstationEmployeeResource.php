<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\SubstationEmployee;

use App\Models\SubstationEmployee;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<SubstationEmployee>
 */
class SubstationEmployeeResource extends ModelResource
{
    protected string $model = SubstationEmployee::class;

    protected string $title = 'Сотрудники подстанций';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Подстанция', 'substation.name')->sortable(),
            Image::make('Фото', 'photo')->disk('public'),
            Text::make('ФИО', 'full_name')->sortable(),
            Text::make('Должность', 'position')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                Select::make('Подстанция', 'substation_id')
                    ->required()
                    ->options(
                        \App\Models\Substation::query()
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->searchable(),
                Image::make('Фото', 'photo')
                    ->disk('public')
                    ->dir('substation-employees'),
                Text::make('ФИО', 'full_name')
                    ->required()
                    ->placeholder('Например: Иванов Иван Иванович'),
                Text::make('Должность', 'position')
                    ->required()
                    ->placeholder('Например: Врач скорой помощи'),
                Textarea::make('Описание', 'description')
                    ->placeholder('Дополнительная информация о сотруднике'),
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
            Text::make('Подстанция', 'substation.name'),
            Image::make('Фото', 'photo')->disk('public'),
            Text::make('ФИО', 'full_name'),
            Text::make('Должность', 'position'),
            Textarea::make('Описание', 'description'),
        ];
    }

    /**
     * @param SubstationEmployee $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'substation_id' => ['required', 'exists:substations,id'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'full_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}

