<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\MedicalEmploymentInfo\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\MedicalEmploymentInfo\MedicalEmploymentInfoResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Fields\File;
use Throwable;


/**
 * @extends DetailPage<MedicalEmploymentInfoResource>
 */
class MedicalEmploymentInfoDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название (русский)', 'title'),
            Text::make('Название (казахский)', 'title_kk'),
            TinyMce::make('Описание (русский)', 'description'),
            TinyMce::make('Описание (казахский)', 'description_kk'),
            Text::make('Название 1 файла (русский)', 'file1_name'),
            File::make('Файл 1 (русский)', 'file1')
                ->disk('public'),
            Text::make('Название 1 файла (казахский)', 'file1_name_kk'),
            File::make('Файл 1 (казахский)', 'file1_kk')
                ->disk('public'),
            Text::make('Название 2 файла (русский)', 'file2_name'),
            File::make('Файл 2 (русский)', 'file2')
                ->disk('public'),
            Text::make('Название 2 файла (казахский)', 'file2_name_kk'),
            File::make('Файл 2 (казахский)', 'file2_kk')
                ->disk('public'),
            Text::make('Название 3 файла (русский)', 'file3_name'),
            File::make('Файл 3 (русский)', 'file3')
                ->disk('public'),
            Text::make('Название 3 файла (казахский)', 'file3_name_kk'),
            File::make('Файл 3 (казахский)', 'file3_kk')
                ->disk('public'),
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
