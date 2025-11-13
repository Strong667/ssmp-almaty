<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Announcement;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Select;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Announcement>
 */
class AnnouncementResource extends ModelResource
{
    protected string $model = Announcement::class;

    protected string $title = 'Объявления';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Категория', 'announcementCategory.title'),
            Textarea::make('Текст', 'text'),
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
                Select::make('Категория', 'announcement_category_id')
                    ->options(
                        AnnouncementCategory::query()
                            ->pluck('title', 'id')
                            ->toArray()
                    )
                    ->required()
                    ->searchable(),
                Textarea::make('Текст объявления', 'text')
                    ->required()
                    ->customAttributes(['rows' => 10])
                    ->placeholder('Введите текст объявления'),
                File::make('Файл для скачивания', 'file_path')
                    ->disk('public')
                    ->dir('announcements')
                    ->allowedExtensions(['pdf', 'doc', 'docx', 'xlsx', 'xls'])
                    ->nullable(),
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
            Text::make('Категория', 'announcementCategory.title'),
            Textarea::make('Текст объявления', 'text'),
            File::make('Файл', 'file_path')->disk('public'),
        ];
    }

    /**
     * @param Announcement $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'announcement_category_id' => ['required', 'exists:announcement_categories,id'],
            'text' => ['required', 'string'],
            'file_path' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xlsx,xls',
                'max:10240'
            ],
        ];
    }
}

