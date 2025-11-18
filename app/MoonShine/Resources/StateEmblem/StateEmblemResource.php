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
            Textarea::make('Описание (русский)', 'description'),
            Textarea::make('Описание (казахский)', 'description_kk'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация (русский)', [
                ID::make()->readonly(),
                Image::make('Изображение', 'image')
                    ->dir('state-symbols')
                    ->disk('public')
                    ->removable()
                    ->required()
                    ->hint('Загрузите изображение герба'),
                Textarea::make('Описание (русский)', 'description')
                    ->required()
                    ->customAttributes(['rows' => 5])
                    ->placeholder('Введите описание герба'),
            ]),
            Box::make('Основная информация (казахский)', [
                Textarea::make('Описание (казахский)', 'description_kk')
                    ->nullable()
                    ->customAttributes(['rows' => 5])
                    ->placeholder('Введите описание герба на казахском'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Image::make('Изображение', 'image')
                ->disk('public'),
            Textarea::make('Описание (русский)', 'description')
                ->readonly()
                ->customAttributes(['rows' => 5]),
            Textarea::make('Описание (казахский)', 'description_kk')
                ->readonly()
                ->customAttributes(['rows' => 5]),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'image' => ['required', 'image'],
            'description' => ['required', 'string'],
            'description_kk' => ['nullable', 'string'],
        ];
    }
}

