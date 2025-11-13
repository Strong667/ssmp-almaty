<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\EmergencyServiceRules;

use App\Models\EmergencyServiceRules;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Textarea};

class EmergencyServiceRulesResource extends ModelResource
{
    protected string $model = EmergencyServiceRules::class;
    protected string $title = 'Правила обращения в службу скорой медицинской помощи';

    /**
     * Поля в таблице (index)
     *
     * @return iterable
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Textarea::make('Текст', 'text'),
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
                Textarea::make('Текст', 'text')
                    ->required()
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
            Textarea::make('Текст', 'text')
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
            'text' => ['required', 'string'],
        ];
    }
}

