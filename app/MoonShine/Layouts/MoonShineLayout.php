<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Crud\Components\Fragment;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When
};
use App\MoonShine\Resources\Setting\SettingResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\News\NewsResource;
use MoonShine\MenuManager\MenuGroup;
use App\MoonShine\Resources\Admin\AdminResource;
use App\MoonShine\Resources\CitizenSchedule\CitizenScheduleResource;
use App\MoonShine\Resources\Structure\StructureResource;
use App\MoonShine\Resources\MissionValue\MissionValueResource;
use App\MoonShine\Resources\EthicalCode\EthicalCodeResource;
use App\MoonShine\Resources\IncomeExpenseReport\IncomeExpenseReportResource;
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

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            ...parent::menu(),
            MenuGroup::make('Главный экран', [
                MenuItem::make(SettingResource::class, 'Settings'),
                MenuItem::make(NewsResource::class, 'News'),
                MenuItem::make(DirectorBlogResource::class, 'Блог о директоре'),
                MenuGroup::make('Антикор', [
                    MenuItem::make(AnticorruptionResource::class, 'Антикор'),
                    MenuItem::make(AnticorruptionImageResource::class, 'Изображения'),
                ]),
                MenuItem::make(MissionOfEmergencyServiceResource::class, 'Миссия скорой помощи'),
                MenuItem::make(HealthyLifestyleResource::class, 'ЗОЖ'),
            ]),
            MenuItem::make(QuestionResource::class, 'Вопросы и ответы'),
            MenuItem::make(DirectorQuestionResource::class, 'Вопросы к директору'),
            MenuGroup::make('О нас', [
                MenuItem::make(AdminResource::class, 'Администрация'),
                MenuItem::make(CitizenScheduleResource::class, 'График приёма граждан'),
                MenuItem::make(StructureResource::class, 'Структура'),
                MenuItem::make(MissionValueResource::class, 'Миссия и ценности'),
                MenuItem::make(EthicalCodeResource::class, 'Этический кодекс'),
                MenuItem::make(IncomeExpenseReportResource::class, 'Отчёты о доходах и расходах'),
                MenuGroup::make('Вакансия', [
                    MenuItem::make(VacancyResource::class, 'Вакансии'),
                    MenuItem::make(MedicalEmploymentInfoResource::class, 'Информация для медицинских специалистов'),
                ]),
                MenuGroup::make('Документы', [
                    MenuItem::make(CorporateDocumentResource::class, 'Категории документов'),
                    MenuItem::make(DocumentResource::class, 'Документы'),
                ]),
                MenuGroup::make('Сфера деятельности', [
                    MenuItem::make(ActivitySphereResource::class, 'Общая информация'),
                    MenuItem::make(SsmpStructureResource::class, 'Структура ССМП'),
                    MenuItem::make(SubstationResource::class, 'Подстанции'),
                    MenuItem::make(SubstationEmployeeResource::class, 'Сотрудники подстанций'),
                ]),
            ]),
            MenuGroup::make('Жителям Алматы', [
                MenuItem::make(MedicalHelpForForeignersResource::class, 'Оказание медицинской помощи иностранному гражданину в РК'),
                MenuItem::make(LegalFrameworkResource::class, 'Нормативно-правовая база'),
                MenuItem::make(EmergencyServiceRulesResource::class, 'Правила обращения в службу скорой медицинской помощи'),
                MenuItem::make(SocialInsuranceResource::class, 'Обязательное социальное медицинское страхование'),
                MenuItem::make(RubricForPopulationResource::class, 'Рубрика для населения'),
            ]),
            MenuGroup::make('Государственные услуги', [
                MenuItem::make(StateServicesResource::class, 'Государственные услуги'),
                MenuItem::make(RegistryOfStateServicesResource::class, 'Реестр государственных услуг'),
                MenuItem::make(StateServiceStandardsResource::class, 'Стандарты государственных услуг'),
                MenuItem::make(StateServiceRegulationsResource::class, 'Регламенты государственных услуг'),
            ]),
            MenuGroup::make('Государственные символы', [
                MenuItem::make(StateFlagResource::class, 'Государственный Флаг'),
                MenuItem::make(StateEmblemResource::class, 'Государственный Герб'),
                MenuItem::make(StateAnthemResource::class, 'Государственный Гимн'),
            ]),
            MenuItem::make(PaidServiceResource::class, 'Платные услуги'),
            MenuGroup::make('Комплаенс служба', [
                MenuItem::make(ComplianceOfficerPlanResource::class, 'План работы комплаенс офицера 2024г'),
                MenuItem::make(InternalCorruptionRiskAnalysisResource::class, 'Внутренний анализ коррупционных рисков'),
                MenuItem::make(InternalRegulationsResource::class, 'Внутренние НПА'),
            ]),
            MenuGroup::make('Картограмма коррупции', [
                MenuItem::make(CorruptionRiskPositionResource::class, 'Должности, подверженные коррупционным рискам'),
                MenuItem::make(CorruptionRiskListResource::class, 'Перечень коррупционных рисков'),
                MenuItem::make(CorruptionRiskMapResource::class, 'Карта коррупционных рисков'),
            ]),
            MenuGroup::make('Государственные закупки', [
                MenuItem::make(ProcurementPlanResource::class, 'План государственных закупок'),
                MenuGroup::make('Объявления', [
                    MenuItem::make(AnnouncementCategoryResource::class, 'Категории объявлений'),
                    MenuItem::make(AnnouncementResource::class, 'Объявления'),
                ]),
                MenuItem::make(ProtocolResource::class, 'Протоколы'),
            ]),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    public function build(): Layout
    {
        return parent::build();
    }
}
