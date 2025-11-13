<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ActivitySphere;

use App\Models\ActivitySphere;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<ActivitySphere>
 */
class ActivitySphereResource extends ModelResource
{
    protected string $model = ActivitySphere::class;

    protected string $title = 'Сфера деятельности';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                Textarea::make('Общая информация об организации', 'general_info')
                    ->customAttributes(['rows' => 10])
                    ->placeholder('Введите общую информацию об организации'),
                Textarea::make('Миссия организации', 'mission')
                    ->customAttributes(['rows' => 8])
                    ->placeholder('Введите миссию организации'),
                Textarea::make('Цель организации', 'goal')
                    ->customAttributes(['rows' => 8])
                    ->placeholder('Введите цель организации'),
                Textarea::make('История ССМП', 'history')
                    ->customAttributes(['rows' => 15])
                    ->placeholder('Введите историю ССМП'),
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
            Textarea::make('Общая информация об организации', 'general_info')->readonly(),
            Textarea::make('Миссия организации', 'mission')->readonly(),
            Textarea::make('Цель организации', 'goal')->readonly(),
            Textarea::make('История ССМП', 'history')->readonly(),
        ];
    }

    /**
     * @param ActivitySphere $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'general_info' => ['nullable', 'string'],
            'mission' => ['nullable', 'string'],
            'goal' => ['nullable', 'string'],
            'history' => ['nullable', 'string'],
        ];
    }
}

