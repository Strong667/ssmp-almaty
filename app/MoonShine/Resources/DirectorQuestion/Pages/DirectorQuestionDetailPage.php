<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\DirectorQuestion\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\DirectorQuestion\DirectorQuestionResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\Date;
use Throwable;

/**
 * @extends DetailPage<DirectorQuestionResource>
 */
class DirectorQuestionDetailPage extends DetailPage
{
    /**
     * Поля на странице просмотра детали
     *
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Имя', 'name'),
            Text::make('Email', 'email'),
            Textarea::make('Вопрос', 'question')
                ->readonly()
                ->customAttributes(['rows' => 5]),
            Textarea::make('Ответ', 'answer')
                ->readonly()
                ->customAttributes(['rows' => 8]),
            Checkbox::make('Опубликовано', 'published'),
            Checkbox::make('Уведомление на email', 'notify_email'),
            Date::make('Создано', 'created_at'),
            Date::make('Обновлено', 'updated_at'),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}

