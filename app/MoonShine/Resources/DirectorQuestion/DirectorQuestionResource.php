<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\DirectorQuestion;

use App\Models\DirectorQuestion;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Resources\DirectorQuestion\Pages\DirectorQuestionIndexPage;
use App\MoonShine\Resources\DirectorQuestion\Pages\DirectorQuestionFormPage;
use App\MoonShine\Resources\DirectorQuestion\Pages\DirectorQuestionDetailPage;

class DirectorQuestionResource extends ModelResource
{
    protected string $model = DirectorQuestion::class;

    protected string $title = 'Вопросы к директору';

    /**
     * @return list<class-string<\MoonShine\Contracts\Core\PageContract>>
     */
    protected function pages(): array
    {
        return [
            DirectorQuestionIndexPage::class,
            DirectorQuestionFormPage::class,
            DirectorQuestionDetailPage::class,
        ];
    }
}

