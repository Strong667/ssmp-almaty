<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\IncomeExpenseReport\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\IncomeExpenseReport\IncomeExpenseReportResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<IncomeExpenseReportResource>
 */
class IncomeExpenseReportFormPage extends FormPage
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
                    ->placeholder('Введите название отчёта'),
                File::make('Файл (русский)', 'file_path')
                    ->allowedExtensions(['pdf', 'xlsx', 'xls', 'doc', 'docx'])
                    ->disk('public')
                    ->dir('income_expense_reports')
                    ->removable()
                    ->hint('Загрузите файл отчёта'),
                Text::make('Название (казахский)', 'title_kk')
                    ->placeholder('Введите название отчёта на казахском языке'),
                File::make('Файл (казахский)', 'file_path_kk')
                    ->allowedExtensions(['pdf', 'xlsx', 'xls', 'doc', 'docx'])
                    ->disk('public')
                    ->dir('income_expense_reports')
                    ->removable()
                    ->hint('Загрузите файл отчёта на казахском языке'),
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
            'file_path' => ['nullable', 'file', 'mimes:pdf,xlsx,xls,doc,docx'],
            'file_path_kk' => ['nullable', 'file', 'mimes:pdf,xlsx,xls,doc,docx'],
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
