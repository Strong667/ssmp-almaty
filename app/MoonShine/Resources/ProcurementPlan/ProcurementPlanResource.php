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
            Text::make('Название', 'title')->sortable(),
            File::make('Файл', 'file_path')->disk('public'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                Text::make('Название', 'title')
                    ->required()
                    ->placeholder('Например: План государственных закупок на 2025 год'),
                File::make('Файл Excel', 'file_path')
                    ->disk('public')
                    ->dir('procurement_plans')
                    ->allowedExtensions(['xlsx', 'xls'])
                    ->required(),
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
            File::make('Файл', 'file_path')->disk('public'),
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
            'file_path' => [
                $item->exists ? 'nullable' : 'required',
                'file',
                'mimes:xlsx,xls',
                'max:10240'
            ],
        ];
    }
}

