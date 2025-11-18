<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\NewsImage;

use App\Models\NewsImage;
use App\Models\News;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Image, Select};
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<NewsImage>
 */
class NewsImageResource extends ModelResource
{
    protected string $model = NewsImage::class;

    protected string $title = 'Изображения новостей';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')->disk('public'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Информация об изображении', [
                Select::make('Новость', 'news_id')
                    ->options(News::pluck('title', 'id')->toArray())
                    ->required()
                    ->searchable()
                    ->when(
                        request()->has('parent_id'),
                        fn($field) => $field->default(request()->get('parent_id'))->readonly()
                    ),
                Image::make('Изображение', 'image')
                    ->dir('news/images')
                    ->disk('public')
                    ->required()
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
            Image::make('Изображение', 'image')->disk('public')->readonly(),
        ];
    }

    /**
     * @param NewsImage $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'news_id' => ['required', 'exists:news,id'],
            'image' => ['required', 'image', 'max:2048'],
        ];
    }
}

