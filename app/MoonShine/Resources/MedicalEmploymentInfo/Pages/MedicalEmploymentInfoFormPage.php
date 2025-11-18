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
                Text::make('Название (русский)', 'title')
                    ->required()
                    ->placeholder('Введите название'),
                Text::make('Название (казахский)', 'title_kk')
                    ->placeholder('Введите название на казахском языке'),
                TinyMce::make('Описание (русский)', 'description')
                    ->placeholder('Введите описание'),
                TinyMce::make('Описание (казахский)', 'description_kk')
                    ->placeholder('Введите описание на казахском языке'),
                Text::make('Название 1 файла (русский)', 'file1_name')
                    ->placeholder('Введите название первого файла'),
                File::make('Файл 1 (русский)', 'file1')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xls', 'xlsx'])
                    ->disk('public')
                    ->dir('medical_employment_infos')
                    ->removable()
                    ->hint('Загрузите первый файл'),
                Text::make('Название 1 файла (казахский)', 'file1_name_kk')
                    ->placeholder('Введите название первого файла на казахском языке'),
                File::make('Файл 1 (казахский)', 'file1_kk')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xls', 'xlsx'])
                    ->disk('public')
                    ->dir('medical_employment_infos')
                    ->removable()
                    ->hint('Загрузите первый файл на казахском языке'),
                Text::make('Название 2 файла (русский)', 'file2_name')
                    ->placeholder('Введите название второго файла'),
                File::make('Файл 2 (русский)', 'file2')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xls', 'xlsx'])
                    ->disk('public')
                    ->dir('medical_employment_infos')
                    ->removable()
                    ->hint('Загрузите второй файл'),
                Text::make('Название 2 файла (казахский)', 'file2_name_kk')
                    ->placeholder('Введите название второго файла на казахском языке'),
                File::make('Файл 2 (казахский)', 'file2_kk')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xls', 'xlsx'])
                    ->disk('public')
                    ->dir('medical_employment_infos')
                    ->removable()
                    ->hint('Загрузите второй файл на казахском языке'),
                Text::make('Название 3 файла (русский)', 'file3_name')
                    ->placeholder('Введите название третьего файла'),
                File::make('Файл 3 (русский)', 'file3')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xls', 'xlsx'])
                    ->disk('public')
                    ->dir('medical_employment_infos')
                    ->removable()
                    ->hint('Загрузите третий файл'),
                Text::make('Название 3 файла (казахский)', 'file3_name_kk')
                    ->placeholder('Введите название третьего файла на казахском языке'),
                File::make('Файл 3 (казахский)', 'file3_kk')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xls', 'xlsx'])
                    ->disk('public')
                    ->dir('medical_employment_infos')
                    ->removable()
                    ->hint('Загрузите третий файл на казахском языке'),
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
            'title_kk' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_kk' => ['nullable', 'string'],
            'file1_name' => ['nullable', 'string', 'max:255'],
            'file1_name_kk' => ['nullable', 'string', 'max:255'],
            'file1' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx'],
            'file1_kk' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx'],
            'file2_name' => ['nullable', 'string', 'max:255'],
            'file2_name_kk' => ['nullable', 'string', 'max:255'],
            'file2' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx'],
            'file2_kk' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx'],
            'file3_name' => ['nullable', 'string', 'max:255'],
            'file3_name_kk' => ['nullable', 'string', 'max:255'],
            'file3' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx'],
            'file3_kk' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx'],
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
