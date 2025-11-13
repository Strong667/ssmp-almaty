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
            Text::make('Название', 'title')->sortable(),
            Text::make('Категория', 'corporateDocument.title'),
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
                Select::make('Категория', 'corporate_document_id')
                    ->options(
                        CorporateDocument::query()
                            ->pluck('title', 'id')
                            ->toArray()
                    )
                    ->required()
                    ->searchable(),
                Text::make('Название документа', 'title')
                    ->required()
                    ->placeholder('Например: Устав организации'),
                File::make('Файл', 'file_path')
                    ->disk('public')
                    ->dir('documents')
                    ->allowedExtensions(['pdf', 'doc', 'docx'])
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
            Text::make('Категория', 'corporateDocument.title'),
            Text::make('Название документа', 'title'),
            File::make('Файл', 'file_path')->disk('public'),
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
            'file_path' => [
                $item->exists ? 'nullable' : 'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:10240'
            ],
        ];
    }
}

