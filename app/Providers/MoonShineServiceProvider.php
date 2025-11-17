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
use App\MoonShine\Resources\SsmpStructure\SsmpStructureResource;
use App\MoonShine\Resources\Substation\SubstationResource;
use App\MoonShine\Resources\SubstationEmployee\SubstationEmployeeResource;
use App\MoonShine\Resources\DirectorBlog\DirectorBlogResource;
use App\MoonShine\Resources\Anticorruption\AnticorruptionResource;
use App\MoonShine\Resources\AnticorruptionImage\AnticorruptionImageResource;
use App\MoonShine\Resources\MissionOfEmergencyService\MissionOfEmergencyServiceResource;
use App\MoonShine\Resources\HealthyLifestyle\HealthyLifestyleResource;
use App\MoonShine\Resources\ProcurementPlan\ProcurementPlanResource;
use App\MoonShine\Resources\AnnouncementCategory\AnnouncementCategoryResource;
use App\MoonShine\Resources\Announcement\AnnouncementResource;
use App\MoonShine\Resources\Protocol\ProtocolResource;
use App\MoonShine\Resources\MedicalHelpForForeigners\MedicalHelpForForeignersResource;
use App\MoonShine\Resources\LegalFramework\LegalFrameworkResource;
use App\MoonShine\Resources\EmergencyServiceRules\EmergencyServiceRulesResource;
use App\MoonShine\Resources\SocialInsurance\SocialInsuranceResource;
use App\MoonShine\Resources\RubricForPopulation\RubricForPopulationResource;
use App\MoonShine\Resources\RegistryOfStateServices\RegistryOfStateServicesResource;
use App\MoonShine\Resources\StateServiceStandards\StateServiceStandardsResource;
use App\MoonShine\Resources\StateServiceRegulations\StateServiceRegulationsResource;
use App\MoonShine\Resources\StateServices\StateServicesResource;
use App\MoonShine\Resources\StateFlag\StateFlagResource;
use App\MoonShine\Resources\StateEmblem\StateEmblemResource;
use App\MoonShine\Resources\StateAnthem\StateAnthemResource;
use App\MoonShine\Resources\PaidService\PaidServiceResource;
use App\MoonShine\Resources\ComplianceOfficerPlan\ComplianceOfficerPlanResource;
use App\MoonShine\Resources\InternalCorruptionRiskAnalysis\InternalCorruptionRiskAnalysisResource;
use App\MoonShine\Resources\InternalRegulations\InternalRegulationsResource;
use App\MoonShine\Resources\CorruptionRiskPosition\CorruptionRiskPositionResource;
use App\MoonShine\Resources\CorruptionRiskList\CorruptionRiskListResource;
use App\MoonShine\Resources\CorruptionRiskMap\CorruptionRiskMapResource;
use App\MoonShine\Resources\Question\QuestionResource;
use App\MoonShine\Resources\DirectorQuestion\DirectorQuestionResource;

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
                SsmpStructureResource::class,
                SubstationResource::class,
                SubstationEmployeeResource::class,
                DirectorBlogResource::class,
                AnticorruptionResource::class,
                AnticorruptionImageResource::class,
                MissionOfEmergencyServiceResource::class,
                HealthyLifestyleResource::class,
                ProcurementPlanResource::class,
                AnnouncementCategoryResource::class,
                AnnouncementResource::class,
                ProtocolResource::class,
                MedicalHelpForForeignersResource::class,
                LegalFrameworkResource::class,
                EmergencyServiceRulesResource::class,
                SocialInsuranceResource::class,
                RubricForPopulationResource::class,
                RegistryOfStateServicesResource::class,
                StateServiceStandardsResource::class,
                StateServiceRegulationsResource::class,
                StateServicesResource::class,
                StateFlagResource::class,
                StateEmblemResource::class,
                StateAnthemResource::class,
                PaidServiceResource::class,
                ComplianceOfficerPlanResource::class,
                InternalCorruptionRiskAnalysisResource::class,
                InternalRegulationsResource::class,
                CorruptionRiskPositionResource::class,
                CorruptionRiskListResource::class,
                CorruptionRiskMapResource::class,
                QuestionResource::class,
                DirectorQuestionResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
