<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ComplianceOfficerPlan;

use App\Models\ComplianceOfficerPlan;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, File};

class ComplianceOfficerPlanResource extends ModelResource
{
    protected string $model = ComplianceOfficerPlan::class;
    protected string $title = 'План работы комплаенс офицера 2024г';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title'),
            File::make('Файл', 'file_path')
                ->disk('public')
                ->readonly(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()->readonly(),
                Text::make('Название', 'title')
                    ->required()
                    ->placeholder('Введите название'),
                File::make('PDF файл', 'file_path')
                    ->dir('compliance-service')
                    ->disk('public')
                    ->removable()
                    ->required()
                    ->allowedExtensions(['pdf'])
                    ->hint('Загрузите PDF файл'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title'),
            File::make('Файл', 'file_path')
                ->disk('public')
                ->readonly(),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string'],
            'file_path' => ['required', 'file', 'mimes:pdf'],
        ];
    }
}

