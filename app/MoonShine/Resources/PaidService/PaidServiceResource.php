<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PaidService;

use App\Models\PaidService;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Image};

class PaidServiceResource extends ModelResource
{
    protected string $model = PaidService::class;
    protected string $title = 'Платные услуги';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->disk('public')
                ->readonly(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()->readonly(),
                Image::make('Изображение', 'image')
                    ->dir('paid-services')
                    ->disk('public')
                    ->removable()
                    ->required()
                    ->hint('Загрузите изображение'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Image::make('Изображение', 'image')
                ->disk('public'),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'image' => ['required', 'image'],
        ];
    }
}

