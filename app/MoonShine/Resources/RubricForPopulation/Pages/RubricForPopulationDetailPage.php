<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\RubricForPopulation\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\RubricForPopulation\RubricForPopulationResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\File;
use Throwable;


/**
 * @extends DetailPage<RubricForPopulationResource>
 */
class RubricForPopulationDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title')
                ->readonly(),
            Image::make('Картинка', 'image')
                ->disk('public'),
            Select::make('Тип контента', 'type')
                ->options([
                    'text' => 'Текст',
                    'pdf' => 'PDF файл',
                    'video' => 'YouTube видео',
                    'images' => 'Изображения',
                ])
                ->readonly(),
            Textarea::make('Описание', 'description')
                ->readonly()
                ->customAttributes(['rows' => 5]),
            Textarea::make('Текст/URL', 'content')
                ->readonly()
                ->customAttributes(['rows' => 10]),
            File::make('PDF файл/Изображение', 'file_path')
                ->disk('public')
                ->readonly(),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    /**
     * @param  TableBuilder  $component
     *
     * @return TableBuilder
     */
    protected function modifyDetailComponent(ComponentContract $component): ComponentContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}

