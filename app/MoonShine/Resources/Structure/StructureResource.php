<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Structure;

use App\Models\Structure;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Image;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Structure>
 */
class StructureResource extends ModelResource
{
    protected string $model = Structure::class;

    protected string $title = 'Структура';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title'),
            Image::make('Изображение (русский)', 'image')->disk('public'),
            Image::make('Изображение (казахский)', 'image_kk')->disk('public'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make(),
                Text::make('Название', 'title')
                    ->required(),

                Image::make('Изображение (русский)', 'image')
                    ->dir('structures') // папка внутри storage/app/public
                    ->disk('public')
                    ->removable(),

                Image::make('Изображение (казахский)', 'image_kk')
                    ->dir('structures') // папка внутри storage/app/public
                    ->disk('public')
                    ->removable(),
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
            Text::make('Название', 'title'),
            Image::make('Изображение (русский)', 'image')->disk('public'),
            Image::make('Изображение (казахский)', 'image_kk')->disk('public'),
        ];
    }

    /**
     * @param Structure $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
            'image_kk' => ['nullable', 'image', 'max:5120'],
        ];
    }
}
