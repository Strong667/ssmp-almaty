<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\SsmpStructure\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\SsmpStructure\SsmpStructureResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\Layout\Box;
use Illuminate\Validation\Rule;
use Throwable;


/**
 * @extends FormPage<SsmpStructureResource>
 */
class SsmpStructureFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Number::make('№ п/с', 'substation_number')
                    ->required()
                    ->min(1)
                    ->placeholder('Введите номер подстанции'),
                Text::make('Адрес', 'address')
                    ->required()
                    ->placeholder('Введите адрес подстанции'),
                Number::make('Кол-во бригад', 'brigades_count')
                    ->required()
                    ->min(0)
                    ->default(0)
                    ->placeholder('Введите количество бригад'),
                Number::make('Кол-во врачей', 'doctors_count')
                    ->required()
                    ->min(0)
                    ->default(0)
                    ->placeholder('Введите количество врачей'),
                Number::make('Кол-во фельдшеров', 'paramedics_count')
                    ->required()
                    ->min(0)
                    ->default(0)
                    ->placeholder('Введите количество фельдшеров'),
                Number::make('Младший персонал', 'junior_staff_count')
                    ->required()
                    ->min(0)
                    ->default(0)
                    ->placeholder('Введите количество младшего персонала'),
                Number::make('Порядок сортировки', 'order')
                    ->default(0)
                    ->hint('Чем меньше число, тем выше в списке'),
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        $id = $item->getKey() ?? null;
        
        return [
            'substation_number' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('ssmp_structures', 'substation_number')->ignore($id),
            ],
            'address' => ['required', 'string', 'max:255'],
            'brigades_count' => ['required', 'integer', 'min:0'],
            'doctors_count' => ['required', 'integer', 'min:0'],
            'paramedics_count' => ['required', 'integer', 'min:0'],
            'junior_staff_count' => ['required', 'integer', 'min:0'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * @param  FormBuilder  $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
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

