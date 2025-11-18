<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Protocol;

use App\Models\Protocol;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\File;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Protocol>
 */
class ProtocolResource extends ModelResource
{
    protected string $model = Protocol::class;

    protected string $title = 'Протоколы';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Number::make('Год', 'year')->sortable(),
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
                Number::make('Год', 'year')
                    ->required()
                    ->min(2000)
                    ->max(2100)
                    ->placeholder('Например: 2025'),
                Text::make('Название протокола (русский)', 'title')
                    ->required()
                    ->placeholder('Например: Протокол заседания от 15.01.2025'),
                File::make('Файл (русский)', 'file_path')
                    ->disk('public')
                    ->dir('protocols')
                    ->allowedExtensions(['pdf', 'doc', 'docx'])
                    ->required(),
            ]),
            Box::make('Основная информация (казахский)', [
                Text::make('Название протокола (казахский)', 'title_kk')
                    ->placeholder('Мысалы: 15.01.2025 күні өткен отырыс хаттамасы'),
                File::make('Файл (казахский)', 'file_path_kk')
                    ->disk('public')
                    ->dir('protocols')
                    ->allowedExtensions(['pdf', 'doc', 'docx'])
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
            Number::make('Год', 'year'),
            Text::make('Название (русский)', 'title'),
            Text::make('Название (казахский)', 'title_kk'),
            File::make('Файл (русский)', 'file_path')->disk('public'),
            File::make('Файл (казахский)', 'file_path_kk')->disk('public'),
        ];
    }

    /**
     * @param Protocol $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'year' => ['required', 'integer', 'min:2000', 'max:2100'],
            'title' => ['required', 'string', 'max:255'],
            'title_kk' => ['nullable', 'string', 'max:255'],
            'file_path' => [
                $item->exists ? 'nullable' : 'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:10240'
            ],
            'file_path_kk' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:10240'
            ],
        ];
    }
}

