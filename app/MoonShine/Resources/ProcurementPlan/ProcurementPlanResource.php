<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ProcurementPlan;

use App\Models\ProcurementPlan;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\File;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<ProcurementPlan>
 */
class ProcurementPlanResource extends ModelResource
{
    protected string $model = ProcurementPlan::class;

    protected string $title = 'План государственных закупок';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название (русский)', 'title')->sortable(),
            Text::make('Название (казахский)', 'title_kk'),
            File::make('Файл (русский)', 'file_path')->disk('public'),
            File::make('Файл (казахский)', 'file_path_kk')->disk('public'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация (русский)', [
                Text::make('Название (русский)', 'title')
                    ->required()
                    ->placeholder('Например: План государственных закупок на 2025 год'),
                File::make('Файл Excel (русский)', 'file_path')
                    ->disk('public')
                    ->dir('procurement_plans')
                    ->allowedExtensions(['xlsx', 'xls'])
                    ->required(),
            ]),
            Box::make('Основная информация (казахский)', [
                Text::make('Название (казахский)', 'title_kk')
                    ->placeholder('Мысалы: 2025 жылға арналған мемлекеттік сатып алулар жоспары'),
                File::make('Файл Excel (казахский)', 'file_path_kk')
                    ->disk('public')
                    ->dir('procurement_plans')
                    ->allowedExtensions(['xlsx', 'xls'])
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
            Text::make('Название (русский)', 'title'),
            Text::make('Название (казахский)', 'title_kk'),
            File::make('Файл (русский)', 'file_path')->disk('public'),
            File::make('Файл (казахский)', 'file_path_kk')->disk('public'),
        ];
    }

    /**
     * @param ProcurementPlan $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'title_kk' => ['nullable', 'string', 'max:255'],
            'file_path' => [
                $item->exists ? 'nullable' : 'required',
                'file',
                'mimes:xlsx,xls',
                'max:10240'
            ],
            'file_path_kk' => [
                'nullable',
                'file',
                'mimes:xlsx,xls',
                'max:10240'
            ],
        ];
    }
}

