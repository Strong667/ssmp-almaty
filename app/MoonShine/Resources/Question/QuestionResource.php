<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Question;

use App\Models\Question;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Resources\Question\Pages\QuestionIndexPage;
use App\MoonShine\Resources\Question\Pages\QuestionFormPage;
use App\MoonShine\Resources\Question\Pages\QuestionDetailPage;

class QuestionResource extends ModelResource
{
    protected string $model = Question::class;

    protected string $title = 'Вопросы и ответы';

    /**
     * @return list<class-string<\MoonShine\Contracts\Core\PageContract>>
     */
    protected function pages(): array
    {
        return [
            QuestionIndexPage::class,
            QuestionFormPage::class,
            QuestionDetailPage::class,
        ];
    }
}

