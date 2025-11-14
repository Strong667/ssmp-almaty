<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\HealthyLifestyle;

use App\Models\HealthyLifestyle;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<HealthyLifestyle>
 */
class HealthyLifestyleResource extends ModelResource
{
    protected string $model = HealthyLifestyle::class;

    protected string $title = 'ЗОЖ';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение (Қаз)', 'image_kk')->disk('public'),
            Image::make('Изображение (Рус)', 'image_ru')->disk('public'),
            Number::make('Порядок', 'order')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Изображения', [
                Image::make('Изображение для казахской версии', 'image_kk')
                    ->disk('public')
                    ->required(),
                Image::make('Изображение для русской версии', 'image_ru')
                    ->disk('public')
                    ->required(),
                Number::make('Порядок сортировки', 'order')
                    ->default(0)
                    ->min(0),
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
            Image::make('Изображение (Қаз)', 'image_kk')->disk('public'),
            Image::make('Изображение (Рус)', 'image_ru')->disk('public'),
            Number::make('Порядок', 'order'),
        ];
    }

    /**
     * @param HealthyLifestyle $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'image_kk' => ['required', 'image', 'max:2048'],
            'image_ru' => ['required', 'image', 'max:2048'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}

