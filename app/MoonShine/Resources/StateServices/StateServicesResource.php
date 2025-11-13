<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\StateServices;

use App\Models\StateServices;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, Textarea};

class StateServicesResource extends ModelResource
{
    protected string $model = StateServices::class;
    protected string $title = 'Государственные услуги';

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

