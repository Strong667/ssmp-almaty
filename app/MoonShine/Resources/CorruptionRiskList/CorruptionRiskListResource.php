<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CorruptionRiskList;

use App\Models\CorruptionRiskList;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, File};

class CorruptionRiskListResource extends ModelResource
{
    protected string $model = CorruptionRiskList::class;
    protected string $title = 'Перечень коррупционных рисков';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название (русский)', 'title'),
            Text::make('Название (казахский)', 'title_kk'),
            File::make('Файл (русский)', 'file_path')
                ->disk('public')
                ->readonly(),
            File::make('Файл (казахский)', 'file_path_kk')
                ->disk('public')
                ->readonly(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация (русский)', [
                ID::make()->readonly(),
                Text::make('Название (русский)', 'title')
                    ->required()
                    ->placeholder('Введите название'),
                File::make('PDF файл (русский)', 'file_path')
                    ->dir('corruption-risk')
                    ->disk('public')
                    ->removable()
                    ->required()
                    ->allowedExtensions(['pdf'])
                    ->hint('Загрузите PDF файл'),
            ]),
            Box::make('Основная информация (казахский)', [
                Text::make('Название (казахский)', 'title_kk')
                    ->nullable()
                    ->placeholder('Введите название на казахском'),
                File::make('PDF файл (казахский)', 'file_path_kk')
                    ->dir('corruption-risk')
                    ->disk('public')
                    ->removable()
                    ->nullable()
                    ->allowedExtensions(['pdf'])
                    ->hint('Загрузите PDF файл на казахском'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название (русский)', 'title'),
            Text::make('Название (казахский)', 'title_kk'),
            File::make('Файл (русский)', 'file_path')
                ->disk('public')
                ->readonly(),
            File::make('Файл (казахский)', 'file_path_kk')
                ->disk('public')
                ->readonly(),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string'],
            'title_kk' => ['nullable', 'string'],
            'file_path' => ['required', 'file', 'mimes:pdf'],
            'file_path_kk' => ['nullable', 'file', 'mimes:pdf'],
        ];
    }
}

