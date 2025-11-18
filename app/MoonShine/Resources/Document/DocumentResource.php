<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Document;

use App\Models\Document;
use App\Models\CorporateDocument;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Select;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Document>
 */
class DocumentResource extends ModelResource
{
    protected string $model = Document::class;

    protected string $title = 'Документы';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название (русский)', 'title')->sortable(),
            Text::make('Название (казахский)', 'title_kk'),
            Text::make('Категория', 'corporateDocument.title'),
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
                Select::make('Категория', 'corporate_document_id')
                    ->options(
                        CorporateDocument::query()
                            ->pluck('title', 'id')
                            ->toArray()
                    )
                    ->required()
                    ->searchable(),
                Text::make('Название документа (русский)', 'title')
                    ->required()
                    ->placeholder('Например: Устав организации'),
                File::make('Файл (русский)', 'file_path')
                    ->disk('public')
                    ->dir('documents')
                    ->allowedExtensions(['pdf', 'doc', 'docx'])
                    ->required(),
            ]),
            Box::make('Основная информация (казахский)', [
                Text::make('Название документа (казахский)', 'title_kk')
                    ->placeholder('Мысалы: Ұйымның жарғысы'),
                File::make('Файл (казахский)', 'file_path_kk')
                    ->disk('public')
                    ->dir('documents')
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
            Text::make('Категория', 'corporateDocument.title'),
            Text::make('Название документа (русский)', 'title'),
            Text::make('Название документа (казахский)', 'title_kk'),
            File::make('Файл (русский)', 'file_path')->disk('public'),
            File::make('Файл (казахский)', 'file_path_kk')->disk('public'),
        ];
    }

    /**
     * @param Document $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'corporate_document_id' => ['required', 'exists:corporate_documents,id'],
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

