<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CorporateDocument;

use App\Models\CorporateDocument;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\File;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<CorporateDocument>
 */
class CorporateDocumentResource extends ModelResource
{
    protected string $model = CorporateDocument::class;

    protected string $title = 'Корпоративные документы';

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
            Box::make('Основная информация', [
                Text::make('Название категории (русский)', 'title')
                    ->required()
                    ->placeholder('Например: КОРПОРАТИВНЫЕ ДОКУМЕНТЫ'),
                Text::make('Название категории (казахский)', 'title_kk')
                    ->placeholder('Мысалы: КОРПОРАТИВТІК ҚҰЖАТТАР'),
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
     * @param CorporateDocument $item
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

