<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\SsmpStructure;

use App\Models\SsmpStructure;
use App\MoonShine\Resources\SsmpStructure\Pages\SsmpStructureIndexPage;
use App\MoonShine\Resources\SsmpStructure\Pages\SsmpStructureFormPage;
use App\MoonShine\Resources\SsmpStructure\Pages\SsmpStructureDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<SsmpStructure, SsmpStructureIndexPage, SsmpStructureFormPage, SsmpStructureDetailPage>
 */
class SsmpStructureResource extends ModelResource
{
    protected string $model = SsmpStructure::class;

    protected string $title = 'Структура ССМП';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            SsmpStructureIndexPage::class,
            SsmpStructureFormPage::class,
            SsmpStructureDetailPage::class,
        ];
    }
}

