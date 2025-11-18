<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\LegalFramework;

use App\Models\LegalFramework;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, Textarea};

class LegalFrameworkResource extends ModelResource
{
    protected string $model = LegalFramework::class;
    protected string $title = 'Нормативно-правовая база';

    /**
     * Поля в таблице (index)
     *
     * @return iterable
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Textarea::make('Текст (русский)', 'text')->sortable(),
            Textarea::make('Текст (казахский)', 'text_kk'),
            Text::make('Ссылка', 'url'),
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
                Textarea::make('Текст (русский)', 'text')
                    ->required()
                    ->customAttributes(['rows' => 5]),
                Text::make('Ссылка', 'url')
                    ->placeholder('https://...')
                    ->hint('URL ссылки на документ или страницу')
                    ->nullable(),
            ]),
            Box::make('Основная информация (казахский)', [
                Textarea::make('Текст (казахский)', 'text_kk')
                    ->nullable()
                    ->customAttributes(['rows' => 5]),
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
            Textarea::make('Текст (русский)', 'text')
                ->readonly()
                ->customAttributes(['rows' => 5]),
            Textarea::make('Текст (казахский)', 'text_kk')
                ->readonly()
                ->customAttributes(['rows' => 5]),
            Text::make('Ссылка', 'url'),
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
            'text' => ['required', 'string'],
            'text_kk' => ['nullable', 'string'],
            'url' => ['nullable', 'url'],
        ];
    }
}

