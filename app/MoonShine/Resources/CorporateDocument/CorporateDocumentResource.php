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
                    ->placeholder('Например: КОРПОРАТИВНЫЕ ДОКУМЕНТЫ'),
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
     * @param CorporateDocument $item
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

