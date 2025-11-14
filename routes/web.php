<?php

use App\Http\Controllers\Storage\PublicStorageController;
use App\Http\Middleware\UseWebGuard;
use App\MoonShine\Resources\Home\Pages\HomePage;
use App\MoonShine\Resources\About\Pages\AdministrationPage;
use App\MoonShine\Resources\About\Pages\SchedulePage;
use App\MoonShine\Resources\About\Pages\StructurePage;
use App\MoonShine\Resources\About\Pages\MissionPage;
use App\MoonShine\Resources\About\Pages\EthicalCodePage;
use App\MoonShine\Resources\About\Pages\IncomeExpensePage;
use App\MoonShine\Resources\About\Pages\VacancyEmploymentPage;
use App\MoonShine\Resources\About\Pages\DocumentsPage;
use App\MoonShine\Resources\About\Pages\ActivitySpherePage;
use App\MoonShine\Resources\About\Pages\ProcurementPlanPage;
use App\MoonShine\Resources\About\Pages\AnnouncementsPage;
use App\MoonShine\Resources\About\Pages\ProtocolsPage;
use App\MoonShine\Resources\About\Pages\NewsListPage;
use App\MoonShine\Resources\About\Pages\NewsDetailPage;
use App\MoonShine\Resources\About\Pages\MedicalHelpForForeignersPage;
use App\MoonShine\Resources\About\Pages\LegalFrameworkPage;
use App\MoonShine\Resources\About\Pages\EmergencyServiceRulesPage;
use App\MoonShine\Resources\About\Pages\SocialInsurancePage;
use App\MoonShine\Resources\About\Pages\RubricForPopulationPage;
use App\MoonShine\Resources\About\Pages\RubricForPopulationDetailPage;
use App\MoonShine\Resources\About\Pages\RegistryOfStateServicesPage;
use App\MoonShine\Resources\About\Pages\StateServiceStandardsPage;
use App\MoonShine\Resources\About\Pages\StateServiceRegulationsPage;
use App\MoonShine\Resources\About\Pages\StateServicesPage;
use App\MoonShine\Resources\About\Pages\StateFlagPage;
use App\MoonShine\Resources\About\Pages\StateEmblemPage;
use App\MoonShine\Resources\About\Pages\StateAnthemPage;
use App\MoonShine\Resources\About\Pages\PaidServicesPage;
use App\MoonShine\Resources\About\Pages\ComplianceOfficerPlanPage;
use App\MoonShine\Resources\About\Pages\InternalCorruptionRiskAnalysisPage;
use App\MoonShine\Resources\About\Pages\InternalRegulationsPage;
use App\MoonShine\Resources\About\Pages\CorruptionRiskPositionPage;
use App\MoonShine\Resources\About\Pages\CorruptionRiskListPage;
use App\MoonShine\Resources\About\Pages\CorruptionRiskMapPage;
use Illuminate\Support\Facades\Route;

Route::get('storage/{path}', PublicStorageController::class)
    ->where('path', '.*')
    ->name('storage.public');

// Middleware для переключения на web guard для публичных страниц
Route::middleware([UseWebGuard::class])->group(function () {
    
    // Главная страница
    Route::get('/', function () {
        $page = app(HomePage::class);
        return $page->render();
    })->name('home');
    
    // Страницы О нас
    Route::get('/about/administration', function () {
        return app(AdministrationPage::class)->render();
    })->name('about.administration');
    
    Route::get('/about/schedule', function () {
        return app(SchedulePage::class)->render();
    })->name('about.schedule');
    
    Route::get('/about/structure', function () {
        return app(StructurePage::class)->render();
    })->name('about.structure');
    
    Route::get('/about/mission', function () {
        return app(MissionPage::class)->render();
    })->name('about.mission');
    
    Route::get('/about/ethical-code', function () {
        return app(EthicalCodePage::class)->render();
    })->name('about.ethical-code');
    
    Route::get('/about/income-expense', function () {
        return app(IncomeExpensePage::class)->render();
    })->name('about.income-expense');
    
    Route::get('/about/vacancy-employment', function () {
        return app(VacancyEmploymentPage::class)->render();
    })->name('about.vacancy-employment');
    
    Route::get('/about/documents', function () {
        return app(DocumentsPage::class)->render();
    })->name('about.documents');
    
    Route::get('/about/activity-sphere', function () {
        return app(ActivitySpherePage::class)->render();
    })->name('about.activity-sphere');
    
    Route::get('/about/procurement-plan', function () {
        return app(ProcurementPlanPage::class)->render();
    })->name('about.procurement-plan');
    
    Route::get('/about/announcements', function () {
        return app(AnnouncementsPage::class)->render();
    })->name('about.announcements');
    
    Route::get('/about/protocols', function () {
        return app(ProtocolsPage::class)->render();
    })->name('about.protocols');
    
    Route::get('/about/medical-help-for-foreigners', function () {
        return app(MedicalHelpForForeignersPage::class)->render();
    })->name('about.medical-help-for-foreigners');
    
    Route::get('/about/legal-framework', function () {
        return app(LegalFrameworkPage::class)->render();
    })->name('about.legal-framework');
    
    Route::get('/about/emergency-service-rules', function () {
        return app(EmergencyServiceRulesPage::class)->render();
    })->name('about.emergency-service-rules');
    
    Route::get('/about/social-insurance', function () {
        return app(SocialInsurancePage::class)->render();
    })->name('about.social-insurance');
    
    Route::get('/about/rubric-for-population', function () {
        return app(RubricForPopulationPage::class)->render();
    })->name('about.rubric-for-population');
    
    Route::get('/about/rubric-for-population/{id}', function (int $id) {
        return app(RubricForPopulationDetailPage::class)->render();
    })->name('about.rubric-for-population.detail');
    
    Route::get('/about/registry-of-state-services', function () {
        return app(RegistryOfStateServicesPage::class)->render();
    })->name('about.registry-of-state-services');
    
    Route::get('/about/state-service-standards', function () {
        return app(StateServiceStandardsPage::class)->render();
    })->name('about.state-service-standards');
    
    Route::get('/about/state-service-regulations', function () {
        return app(StateServiceRegulationsPage::class)->render();
    })->name('about.state-service-regulations');
    
    Route::get('/about/state-services', function () {
        return app(StateServicesPage::class)->render();
    })->name('about.state-services');
    
    // Государственные символы
    Route::get('/about/state-symbols/flag', function () {
        return app(StateFlagPage::class)->render();
    })->name('about.state-flag');
    
    Route::get('/about/state-symbols/emblem', function () {
        return app(StateEmblemPage::class)->render();
    })->name('about.state-emblem');
    
    Route::get('/about/state-symbols/anthem', function () {
        return app(StateAnthemPage::class)->render();
    })->name('about.state-anthem');
    
    Route::get('/about/paid-services', function () {
        return app(PaidServicesPage::class)->render();
    })->name('about.paid-services');
    
    // Комплаенс служба
    Route::get('/about/compliance-service/officer-plan', function () {
        return app(ComplianceOfficerPlanPage::class)->render();
    })->name('about.compliance-officer-plan');
    
    Route::get('/about/compliance-service/corruption-risk-analysis', function () {
        return app(InternalCorruptionRiskAnalysisPage::class)->render();
    })->name('about.corruption-risk-analysis');
    
    Route::get('/about/compliance-service/internal-regulations', function () {
        return app(InternalRegulationsPage::class)->render();
    })->name('about.internal-regulations');
    
    // Картограмма коррупции
    Route::get('/about/corruption-risk-map/positions', function () {
        return app(CorruptionRiskPositionPage::class)->render();
    })->name('about.corruption-risk-positions');
    
    Route::get('/about/corruption-risk-map/list', function () {
        return app(CorruptionRiskListPage::class)->render();
    })->name('about.corruption-risk-list');
    
    Route::get('/about/corruption-risk-map/map', function () {
        return app(CorruptionRiskMapPage::class)->render();
    })->name('about.corruption-risk-map');
    
    // Новости
    Route::get('/news', function () {
        return app(NewsListPage::class)->render();
    })->name('news.list');
    
    Route::get('/news/{slug}', function (string $slug) {
        return app(NewsDetailPage::class)->render();
    })->name('news.detail');
});

