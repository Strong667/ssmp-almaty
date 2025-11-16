<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Question\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\Question\QuestionResource;
use MoonShine\Support\ListOf;
use Throwable;

/**
 * @extends FormPage<QuestionResource>
 */
class QuestionFormPage extends FormPage
{
    /**
     * Поля формы редактирования (создание вопросов только через публичную форму)
     *
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make('Информация о пользователе', [
                ID::make()->readonly(),
                Text::make('Имя', 'name')
                    ->readonly()
                    ->hint('Имя пользователя (только для чтения)'),
                Text::make('Email', 'email')
                    ->readonly()
                    ->hint('Email пользователя (только для чтения)'),
            ]),
            Box::make('Вопрос и ответ', [
                Textarea::make('Вопрос', 'question')
                    ->readonly()
                    ->customAttributes(['rows' => 5])
                    ->hint('Вопрос от пользователя (только для чтения)'),
                Textarea::make('Ответ', 'answer')
                    ->nullable()
                    ->customAttributes(['rows' => 8])
                    ->hint('Введите ответ на вопрос. После ввода ответа можно опубликовать вопрос.'),
                Checkbox::make('Опубликовано', 'published')
                    ->hint('Опубликовать вопрос и ответ на сайте (можно только если есть ответ)'),
            ]),
        ];
    }

    /**
     * Валидация
     */
    protected function rules(DataWrapperContract $item): array
    {
        return [
            'answer' => ['nullable', 'string'],
            'published' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Запретить создание новых вопросов через админ-панель
     * Вопросы создаются только через публичную форму
     */
    protected function canCreate(): bool
    {
        return false;
    }
}

