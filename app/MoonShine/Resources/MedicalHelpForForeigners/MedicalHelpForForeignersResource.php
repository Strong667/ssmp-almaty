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
            Text::make('Название (русский)', 'title')->sortable(),
            Text::make('Название (казахский)', 'title_kk'),
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
            Box::make('Основная информация (русский)', [
                ID::make()->readonly(),
                Text::make('Название (русский)', 'title')
                    ->required(),
                Textarea::make('Описание (русский)', 'description')
                    ->nullable()
                    ->customAttributes(['rows' => 10]),
            ]),
            Box::make('Основная информация (казахский)', [
                Text::make('Название (казахский)', 'title_kk')
                    ->nullable(),
                Textarea::make('Описание (казахский)', 'description_kk')
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
            Text::make('Название (русский)', 'title'),
            Text::make('Название (казахский)', 'title_kk'),
            Textarea::make('Описание (русский)', 'description')
                ->readonly()
                ->customAttributes(['rows' => 10]),
            Textarea::make('Описание (казахский)', 'description_kk')
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
            'title_kk' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_kk' => ['nullable', 'string'],
        ];
    }
}

