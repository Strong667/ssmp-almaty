<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Anticorruption;

use App\Models\Anticorruption;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\AnticorruptionImage\AnticorruptionImageResource;

/**
 * @extends ModelResource<Anticorruption>
 */
class AnticorruptionResource extends ModelResource
{
    protected string $model = Anticorruption::class;

    protected string $title = 'Антикор';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                Text::make('Заголовок', 'title')
                    ->required()
                    ->placeholder('Введите заголовок'),
                Textarea::make('Описание', 'description')
                    ->nullable(),
            ]),
            Box::make('Дополнительная информация', [
                Textarea::make('Задачи Службы', 'service_tasks')
                    ->nullable()
                    ->placeholder('Опишите задачи службы'),
                Textarea::make('Call-центр', 'call_center')
                    ->nullable()
                    ->placeholder('Информация о Call-центре'),
                Textarea::make('Комплаенс-офицер', 'compliance_officer')
                    ->nullable()
                    ->placeholder('Информация о комплаенс-офицере'),
            ]),
            HasMany::make('Изображения', 'images', resource: AnticorruptionImageResource::class)
                ->creatable(),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Заголовок', 'title'),
            Textarea::make('Описание', 'description'),
            Textarea::make('Задачи Службы', 'service_tasks'),
            Textarea::make('Call-центр', 'call_center'),
            Textarea::make('Комплаенс-офицер', 'compliance_officer'),
        ];
    }

    /**
     * @param Anticorruption $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'service_tasks' => ['nullable', 'string'],
            'call_center' => ['nullable', 'string'],
            'compliance_officer' => ['nullable', 'string'],
        ];
    }
}

