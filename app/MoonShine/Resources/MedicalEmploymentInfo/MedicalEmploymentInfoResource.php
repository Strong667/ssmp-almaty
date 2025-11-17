<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\MedicalEmploymentInfo;

use App\Models\MedicalEmploymentInfo;
use App\MoonShine\Resources\MedicalEmploymentInfo\Pages\MedicalEmploymentInfoIndexPage;
use App\MoonShine\Resources\MedicalEmploymentInfo\Pages\MedicalEmploymentInfoFormPage;
use App\MoonShine\Resources\MedicalEmploymentInfo\Pages\MedicalEmploymentInfoDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<MedicalEmploymentInfo, MedicalEmploymentInfoIndexPage, MedicalEmploymentInfoFormPage, MedicalEmploymentInfoDetailPage>
 */
class MedicalEmploymentInfoResource extends ModelResource
{
    protected string $model = MedicalEmploymentInfo::class;

    protected string $title = 'Информация для медицинских специалистов';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            MedicalEmploymentInfoIndexPage::class,
            MedicalEmploymentInfoFormPage::class,
            MedicalEmploymentInfoDetailPage::class,
        ];
    }
}
