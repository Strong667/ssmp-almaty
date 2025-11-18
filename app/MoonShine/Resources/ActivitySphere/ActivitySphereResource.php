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
            Box::make('Основная информация (русский)', [
                Textarea::make('Общая информация об организации (русский)', 'general_info')
                    ->customAttributes(['rows' => 10])
                    ->placeholder('Введите общую информацию об организации'),
                Textarea::make('Миссия организации (русский)', 'mission')
                    ->customAttributes(['rows' => 8])
                    ->placeholder('Введите миссию организации'),
                Textarea::make('Цель организации (русский)', 'goal')
                    ->customAttributes(['rows' => 8])
                    ->placeholder('Введите цель организации'),
                Textarea::make('История ССМП (русский)', 'history')
                    ->customAttributes(['rows' => 15])
                    ->placeholder('Введите историю ССМП'),
            ]),
            Box::make('Основная информация (казахский)', [
                Textarea::make('Общая информация об организации (казахский)', 'general_info_kk')
                    ->customAttributes(['rows' => 10])
                    ->placeholder('Ұйым туралы жалпы ақпаратты енгізіңіз'),
                Textarea::make('Миссия организации (казахский)', 'mission_kk')
                    ->customAttributes(['rows' => 8])
                    ->placeholder('Ұйымның миссиясын енгізіңіз'),
                Textarea::make('Цель организации (казахский)', 'goal_kk')
                    ->customAttributes(['rows' => 8])
                    ->placeholder('Ұйымның мақсатын енгізіңіз'),
                Textarea::make('История ССМП (казахский)', 'history_kk')
                    ->customAttributes(['rows' => 15])
                    ->placeholder('ЖМК тарихын енгізіңіз'),
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
            Textarea::make('Общая информация об организации (русский)', 'general_info')->readonly(),
            Textarea::make('Общая информация об организации (казахский)', 'general_info_kk')->readonly(),
            Textarea::make('Миссия организации (русский)', 'mission')->readonly(),
            Textarea::make('Миссия организации (казахский)', 'mission_kk')->readonly(),
            Textarea::make('Цель организации (русский)', 'goal')->readonly(),
            Textarea::make('Цель организации (казахский)', 'goal_kk')->readonly(),
            Textarea::make('История ССМП (русский)', 'history')->readonly(),
            Textarea::make('История ССМП (казахский)', 'history_kk')->readonly(),
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
            'general_info_kk' => ['nullable', 'string'],
            'mission' => ['nullable', 'string'],
            'mission_kk' => ['nullable', 'string'],
            'goal' => ['nullable', 'string'],
            'goal_kk' => ['nullable', 'string'],
            'history' => ['nullable', 'string'],
            'history_kk' => ['nullable', 'string'],
        ];
    }
}

