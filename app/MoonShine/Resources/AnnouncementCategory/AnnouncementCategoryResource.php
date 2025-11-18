<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\AnnouncementCategory;

use App\Models\AnnouncementCategory;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<AnnouncementCategory>
 */
class AnnouncementCategoryResource extends ModelResource
{
    protected string $model = AnnouncementCategory::class;

    protected string $title = 'Категории объявлений';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название категории (русский)', 'title')->sortable(),
            Text::make('Название категории (казахский)', 'title_kk'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация (русский)', [
                Text::make('Название категории (русский)', 'title')
                    ->required()
                    ->placeholder('Например: Важные объявления'),
            ]),
            Box::make('Основная информация (казахский)', [
                Text::make('Название категории (казахский)', 'title_kk')
                    ->placeholder('Мысалы: Маңызды хабарландырулар'),
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
            Text::make('Название категории (русский)', 'title'),
            Text::make('Название категории (казахский)', 'title_kk'),
        ];
    }

    /**
     * @param AnnouncementCategory $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'title_kk' => ['nullable', 'string', 'max:255'],
        ];
    }
}

