<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\RubricForPopulation;

use App\Models\RubricForPopulation;
use App\MoonShine\Resources\RubricForPopulation\Pages\RubricForPopulationIndexPage;
use App\MoonShine\Resources\RubricForPopulation\Pages\RubricForPopulationFormPage;
use App\MoonShine\Resources\RubricForPopulation\Pages\RubricForPopulationDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<RubricForPopulation, RubricForPopulationIndexPage, RubricForPopulationFormPage, RubricForPopulationDetailPage>
 */
class RubricForPopulationResource extends ModelResource
{
    protected string $model = RubricForPopulation::class;

    protected string $title = 'Рубрика для населения';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            RubricForPopulationIndexPage::class,
            RubricForPopulationFormPage::class,
            RubricForPopulationDetailPage::class,
        ];
    }
}
