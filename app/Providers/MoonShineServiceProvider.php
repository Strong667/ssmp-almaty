<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use App\MoonShine\Resources\Setting\SettingResource;
use App\MoonShine\Resources\News\NewsResource;
use App\MoonShine\Resources\Admin\AdminResource;
use App\MoonShine\Resources\CitizenSchedule\CitizenScheduleResource;
use App\MoonShine\Resources\Structure\StructureResource;
use App\MoonShine\Resources\MissionValue\MissionValueResource;
use App\MoonShine\Resources\EthicalCode\EthicalCodeResource;
use App\MoonShine\Resources\IncomeExpenseReport\IncomeExpenseReportResource;
use App\MoonShine\Resources\Home\HomeResource;
use App\MoonShine\Resources\About\AboutResource;
use App\MoonShine\Resources\Vacancy\VacancyResource;
use App\MoonShine\Resources\MedicalEmploymentInfo\MedicalEmploymentInfoResource;
use App\MoonShine\Resources\CorporateDocument\CorporateDocumentResource;
use App\MoonShine\Resources\Document\DocumentResource;
use App\MoonShine\Resources\ActivitySphere\ActivitySphereResource;
use App\MoonShine\Resources\Substation\SubstationResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                SettingResource::class,
                NewsResource::class,
                AdminResource::class,
                CitizenScheduleResource::class,
                StructureResource::class,
                MissionValueResource::class,
                EthicalCodeResource::class,
                IncomeExpenseReportResource::class,
                HomeResource::class,
                AboutResource::class,
                VacancyResource::class,
                MedicalEmploymentInfoResource::class,
                CorporateDocumentResource::class,
                DocumentResource::class,
                ActivitySphereResource::class,
                SubstationResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
