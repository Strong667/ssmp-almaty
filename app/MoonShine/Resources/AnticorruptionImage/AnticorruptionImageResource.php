<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\AnticorruptionImage;

use App\Models\AnticorruptionImage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use App\Models\Anticorruption;

/**
 * @extends ModelResource<AnticorruptionImage>
 */
class AnticorruptionImageResource extends ModelResource
{
    protected string $model = AnticorruptionImage::class;

    protected string $title = 'Изображения антикоррупции';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')->disk('public'),
            Checkbox::make('Для заголовка', 'is_header'),
            Number::make('Порядок', 'order')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Информация об изображении', [
                Select::make('Антикоррупция', 'anticorruption_id')
                    ->options(Anticorruption::pluck('title', 'id')->toArray())
                    ->required()
                    ->searchable(),
                Image::make('Изображение', 'image')
                    ->disk('public')
                    ->required(),
                Checkbox::make('Использовать для заголовка', 'is_header')
                    ->default(false),
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
            Image::make('Изображение', 'image')->disk('public'),
            Checkbox::make('Для заголовка', 'is_header'),
            Number::make('Порядок', 'order'),
        ];
    }

    /**
     * @param AnticorruptionImage $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'anticorruption_id' => ['required', 'exists:anticorruptions,id'],
            'image' => ['required', 'image', 'max:2048'],
            'is_header' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}

