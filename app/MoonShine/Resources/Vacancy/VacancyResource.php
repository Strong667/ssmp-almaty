<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Vacancy;

use App\Models\Vacancy;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Vacancy>
 */
class VacancyResource extends ModelResource
{
    protected string $model = Vacancy::class;

    protected string $title = 'Вакансии';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок (русский)', 'title')->sortable(),
            Text::make('Заголовок (казахский)', 'title_kk'),
            Text::make('График работы (русский)', 'schedule'),
            Text::make('График работы (казахский)', 'schedule_kk'),
            Text::make('Контактные данные', 'contact_info'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация (русский)', [
                Text::make('Заголовок (русский)', 'title')
                    ->required()
                    ->placeholder('Например: Ведущий специалист по охране труда'),
                Textarea::make('Описание (русский)', 'description')
                    ->required()
                    ->customAttributes(['rows' => 10])
                    ->placeholder('Подробное описание вакансии, требования, обязанности'),
                Text::make('График работы (русский)', 'schedule')
                    ->placeholder('Например: Полный рабочий день, 5/2')
                    ->nullable(),
            ]),
            Box::make('Основная информация (казахский)', [
                Text::make('Заголовок (казахский)', 'title_kk')
                    ->placeholder('Например: Еңбекті қорғау бойынша жетекші маман'),
                Textarea::make('Описание (казахский)', 'description_kk')
                    ->customAttributes(['rows' => 10])
                    ->placeholder('Бос орынның толық сипаттамасы, талаптар, міндеттер'),
                Text::make('График работы (казахский)', 'schedule_kk')
                    ->placeholder('Мысалы: Толық жұмыс күні, 5/2')
                    ->nullable(),
            ]),
            Box::make('Контактная информация', [
                Text::make('Контактные данные', 'contact_info')
                    ->placeholder('Email или телефон для связи')
                    ->nullable(),
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
            Text::make('Заголовок (русский)', 'title'),
            Text::make('Заголовок (казахский)', 'title_kk'),
            Textarea::make('Описание (русский)', 'description'),
            Textarea::make('Описание (казахский)', 'description_kk'),
            Text::make('График работы (русский)', 'schedule'),
            Text::make('График работы (казахский)', 'schedule_kk'),
            Text::make('Контактные данные', 'contact_info'),
        ];
    }

    /**
     * @param Vacancy $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'title_kk' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'description_kk' => ['nullable', 'string'],
            'schedule' => ['nullable', 'string', 'max:255'],
            'schedule_kk' => ['nullable', 'string', 'max:255'],
            'contact_info' => ['nullable', 'string', 'max:255'],
        ];
    }
}
