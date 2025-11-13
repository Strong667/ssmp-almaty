<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\MedicalHelpForForeigners;

use App\Models\MedicalHelpForForeigners;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, Textarea};

class MedicalHelpForForeignersResource extends ModelResource
{
    protected string $model = MedicalHelpForForeigners::class;
    protected string $title = 'Оказание медицинской помощи иностранному гражданину в РК';

    /**
     * Поля в таблице (index)
     *
     * @return iterable
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title')->sortable(),
        ];
    }

    /**
     * Поля в форме создания/редактирования
     *
     * @return iterable
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()->readonly(),
                Text::make('Название', 'title')
                    ->required(),
                Textarea::make('Описание', 'description')
                    ->nullable()
                    ->customAttributes(['rows' => 10]),
            ]),
        ];
    }

    /**
     * Поля на странице просмотра детали
     *
     * @return iterable
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title'),
            Textarea::make('Описание', 'description')
                ->readonly()
                ->customAttributes(['rows' => 10]),
        ];
    }

    /**
     * Правила валидации
     *
     * @param  mixed  $item
     * @return array
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}

