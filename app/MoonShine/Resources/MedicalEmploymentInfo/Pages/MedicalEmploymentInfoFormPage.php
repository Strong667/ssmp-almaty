<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\MedicalEmploymentInfo\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\MedicalEmploymentInfo\MedicalEmploymentInfoResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<MedicalEmploymentInfoResource>
 */
class MedicalEmploymentInfoFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Название', 'title')
                    ->required()
                    ->placeholder('Введите название'),
                TinyMce::make('Описание', 'description')
                    ->placeholder('Введите описание'),
                Text::make('Название 1 файла', 'file1_name')
                    ->placeholder('Введите название первого файла'),
                File::make('Файл 1', 'file1')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xls', 'xlsx'])
                    ->disk('public')
                    ->dir('medical_employment_infos')
                    ->removable()
                    ->hint('Загрузите первый файл'),
                Text::make('Название 2 файла', 'file2_name')
                    ->placeholder('Введите название второго файла'),
                File::make('Файл 2', 'file2')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xls', 'xlsx'])
                    ->disk('public')
                    ->dir('medical_employment_infos')
                    ->removable()
                    ->hint('Загрузите второй файл'),
                Text::make('Название 3 файла', 'file3_name')
                    ->placeholder('Введите название третьего файла'),
                File::make('Файл 3', 'file3')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xls', 'xlsx'])
                    ->disk('public')
                    ->dir('medical_employment_infos')
                    ->removable()
                    ->hint('Загрузите третий файл'),
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
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'file1_name' => ['nullable', 'string', 'max:255'],
            'file1' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx'],
            'file2_name' => ['nullable', 'string', 'max:255'],
            'file2' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx'],
            'file3_name' => ['nullable', 'string', 'max:255'],
            'file3' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx'],
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
