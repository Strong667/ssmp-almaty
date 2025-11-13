<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\StateEmblem;

use App\Models\StateEmblem;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Image, Textarea};

class StateEmblemResource extends ModelResource
{
    protected string $model = StateEmblem::class;
    protected string $title = 'Государственный Герб';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->disk('public')
                ->readonly(),
            Textarea::make('Описание', 'description'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()->readonly(),
                Image::make('Изображение', 'image')
                    ->dir('state-symbols')
                    ->disk('public')
                    ->removable()
                    ->required()
                    ->hint('Загрузите изображение герба'),
                Textarea::make('Описание', 'description')
                    ->required()
                    ->customAttributes(['rows' => 5])
                    ->placeholder('Введите описание герба'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Image::make('Изображение', 'image')
                ->disk('public'),
            Textarea::make('Описание', 'description')
                ->readonly()
                ->customAttributes(['rows' => 5]),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'image' => ['required', 'image'],
            'description' => ['required', 'string'],
        ];
    }
}

