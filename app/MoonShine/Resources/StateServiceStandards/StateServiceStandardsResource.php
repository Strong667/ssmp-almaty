<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\StateServiceStandards;

use App\Models\StateServiceStandards;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, Textarea};

class StateServiceStandardsResource extends ModelResource
{
    protected string $model = StateServiceStandards::class;
    protected string $title = 'Стандарты государственных услуг';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Textarea::make('Текст', 'text')->sortable(),
            Text::make('Ссылка', 'url'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()->readonly(),
                Textarea::make('Текст', 'text')
                    ->required()
                    ->customAttributes(['rows' => 5]),
                Text::make('Ссылка', 'url')
                    ->placeholder('https://...')
                    ->hint('URL ссылки на документ или страницу')
                    ->nullable(),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Textarea::make('Текст', 'text')
                ->readonly()
                ->customAttributes(['rows' => 5]),
            Text::make('Ссылка', 'url'),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'text' => ['required', 'string'],
            'url' => ['nullable', 'url'],
        ];
    }
}

