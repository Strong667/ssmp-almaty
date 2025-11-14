<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\DirectorBlog;

use App\Models\DirectorBlog;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Date;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<DirectorBlog>
 */
class DirectorBlogResource extends ModelResource
{
    protected string $model = DirectorBlog::class;

    protected string $title = 'Блог о директоре';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Фото', 'photo')->disk('public'),
            Text::make('ФИО', 'full_name')->sortable(),
            Date::make('Дата рождения', 'birth_date')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                Image::make('Фото', 'photo')
                    ->disk('public')
                    ->nullable(),
                Text::make('ФИО', 'full_name')
                    ->required()
                    ->placeholder('Например: Иванов Иван Иванович'),
                Date::make('Дата рождения', 'birth_date')
                    ->nullable(),
            ]),
            Box::make('Дополнительная информация', [
                Textarea::make('Личная информация', 'personal_info')
                    ->nullable(),
                Textarea::make('Образования', 'education')
                    ->nullable()
                    ->placeholder('Укажите образовательные учреждения, специальности, годы обучения'),
                Textarea::make('Карьера', 'career')
                    ->nullable()
                    ->placeholder('Опишите карьерный путь, должности, достижения'),
                Textarea::make('Ассоциированный профессор РАМ', 'associate_professor_ram')
                    ->nullable()
                    ->placeholder('Информация об ассоциированном профессоре РАМ'),
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
            Image::make('Фото', 'photo')->disk('public'),
            Text::make('ФИО', 'full_name'),
            Date::make('Дата рождения', 'birth_date'),
            Textarea::make('Личная информация', 'personal_info'),
            Textarea::make('Образования', 'education'),
            Textarea::make('Карьера', 'career'),
            Textarea::make('Ассоциированный профессор РАМ', 'associate_professor_ram'),
        ];
    }

    /**
     * @param DirectorBlog $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'photo' => ['nullable', 'image', 'max:2048'],
            'full_name' => ['required', 'string', 'max:255'],
            'personal_info' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'date'],
            'education' => ['nullable', 'string'],
            'career' => ['nullable', 'string'],
            'associate_professor_ram' => ['nullable', 'string'],
        ];
    }
}

