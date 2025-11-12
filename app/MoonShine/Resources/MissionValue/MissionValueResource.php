<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\MissionValue;

use App\Models\MissionValue;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, Textarea};
use MoonShine\Contracts\UI\{FieldContract, ComponentContract};

/**
 * @extends ModelResource<MissionValue>
 */
class MissionValueResource extends ModelResource
{
    protected string $model = MissionValue::class;

    protected string $title = 'Миссия и ценности';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make(),
                Text::make('Заголовок', 'title')
                    ->required(),
                Textarea::make('Описание', 'description')
                    ->customAttributes(['rows' => 6])
                    ->required(),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Заголовок', 'title'),
            Textarea::make('Описание', 'description'),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ];
    }
}
