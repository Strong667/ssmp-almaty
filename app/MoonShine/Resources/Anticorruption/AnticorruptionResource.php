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
            Box::make('Основная информация (Русский)', [
                Text::make('Заголовок', 'title')
                    ->required()
                    ->placeholder('Введите заголовок'),
                Textarea::make('Описание', 'description')
                    ->nullable(),
            ]),
            Box::make('Основная информация (Казахский)', [
                Text::make('Заголовок (Қазақша)', 'title_kk')
                    ->nullable()
                    ->hint('Если не заполнено, будет использован русский заголовок'),
                Textarea::make('Описание (Қазақша)', 'description_kk')
                    ->nullable()
                    ->hint('Если не заполнено, будет использовано русское описание'),
            ]),
            Box::make('Дополнительная информация (Русский)', [
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
            Box::make('Дополнительная информация (Казахский)', [
                Textarea::make('Задачи Службы (Қазақша)', 'service_tasks_kk')
                    ->nullable()
                    ->placeholder('Қызмет міндеттерін сипаттаңыз')
                    ->hint('Если не заполнено, будет использована русская версия'),
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
            Text::make('Заголовок (Қазақша)', 'title_kk'),
            Textarea::make('Описание', 'description'),
            Textarea::make('Описание (Қазақша)', 'description_kk'),
            Textarea::make('Задачи Службы', 'service_tasks'),
            Textarea::make('Задачи Службы (Қазақша)', 'service_tasks_kk'),
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
            'title_kk' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_kk' => ['nullable', 'string'],
            'service_tasks' => ['nullable', 'string'],
            'service_tasks_kk' => ['nullable', 'string'],
            'call_center' => ['nullable', 'string'],
            'compliance_officer' => ['nullable', 'string'],
        ];
    }
}

