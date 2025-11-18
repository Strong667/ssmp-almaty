<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\SsmpStructure\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\SsmpStructure\SsmpStructureResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use Throwable;


/**
 * @extends DetailPage<SsmpStructureResource>
 */
class SsmpStructureDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Number::make('№ п/с', 'substation_number'),
            Text::make('Адрес (русский)', 'address'),
            Text::make('Адрес (казахский)', 'address_kk'),
            Number::make('Кол-во бригад', 'brigades_count'),
            Number::make('Кол-во врачей', 'doctors_count'),
            Number::make('Кол-во фельдшеров', 'paramedics_count'),
            Number::make('Младший персонал', 'junior_staff_count'),
            Number::make('Порядок сортировки', 'order'),
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

