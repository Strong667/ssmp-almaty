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
            Text::make('Название категории', 'title')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                Text::make('Название категории', 'title')
                    ->required()
                    ->placeholder('Например: Важные объявления'),
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
            Text::make('Название категории', 'title'),
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
        ];
    }
}

