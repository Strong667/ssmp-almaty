<?php

use App\Http\Controllers\Storage\PublicStorageController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\SubstationController;
use App\Http\Controllers\Frontend\DirectorBlogController;
use App\Http\Controllers\Frontend\AnticorruptionController;
use App\Http\Controllers\Frontend\MissionOfEmergencyServiceController;
use App\Http\Controllers\Frontend\HealthyLifestyleController;
use App\Http\Middleware\UseWebGuard;
use App\MoonShine\Resources\About\Pages\EthicalCodePage;
use App\MoonShine\Resources\About\Pages\IncomeExpensePage;
use App\MoonShine\Resources\About\Pages\VacancyEmploymentPage;
use App\MoonShine\Resources\About\Pages\DocumentsPage;
use App\MoonShine\Resources\About\Pages\ActivitySpherePage;
use App\MoonShine\Resources\About\Pages\ProcurementPlanPage;
use App\MoonShine\Resources\About\Pages\AnnouncementsPage;
use App\MoonShine\Resources\About\Pages\ProtocolsPage;
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
    Route::get('/', [FrontendController::class, 'home'])->name('home');
    
    // Страницы О нас (через blade views)
    Route::get('/about/administration', [FrontendController::class, 'administration'])->name('about.administration');
    Route::get('/about/schedule', [FrontendController::class, 'schedule'])->name('about.schedule');
    Route::get('/about/structure', [FrontendController::class, 'structure'])->name('about.structure');
    Route::get('/about/mission', [FrontendController::class, 'mission'])->name('about.mission');
    Route::get('/about/ethical-code', [AboutController::class, 'ethicalCode'])->name('about.ethical-code');
    Route::get('/about/income-expense', [AboutController::class, 'incomeExpense'])->name('about.income-expense');
    Route::get('/about/vacancy-employment', [AboutController::class, 'vacancyEmployment'])->name('about.vacancy-employment');
    Route::get('/about/documents', [AboutController::class, 'documents'])->name('about.documents');
    Route::get('/about/activity-sphere', [AboutController::class, 'activitySphere'])->name('about.activity-sphere');
    Route::get('/about/procurement-plan', [AboutController::class, 'procurementPlan'])->name('about.procurement-plan');
    Route::get('/about/announcements', [AboutController::class, 'announcements'])->name('about.announcements');
    Route::get('/about/protocols', [AboutController::class, 'protocols'])->name('about.protocols');
    
    // Остальные страницы через MoonShine Pages (будут переделаны позже)
    
    Route::get('/about/medical-help-for-foreigners', [AboutController::class, 'medicalHelpForForeigners'])->name('about.medical-help-for-foreigners');
    Route::get('/about/legal-framework', [AboutController::class, 'legalFramework'])->name('about.legal-framework');
    Route::get('/about/emergency-service-rules', [AboutController::class, 'emergencyServiceRules'])->name('about.emergency-service-rules');
    Route::get('/about/social-insurance', [AboutController::class, 'socialInsurance'])->name('about.social-insurance');
    
    Route::get('/about/rubric-for-population', [AboutController::class, 'rubricForPopulation'])->name('about.rubric-for-population');
    Route::get('/about/rubric-for-population/{id}', [AboutController::class, 'rubricForPopulationDetail'])->name('about.rubric-for-population.detail');
    
    Route::get('/about/state-services', [AboutController::class, 'stateServices'])->name('about.state-services');
    Route::get('/about/registry-of-state-services', [AboutController::class, 'registryOfStateServices'])->name('about.registry-of-state-services');
    Route::get('/about/state-service-standards', [AboutController::class, 'stateServiceStandards'])->name('about.state-service-standards');
    Route::get('/about/state-service-regulations', [AboutController::class, 'stateServiceRegulations'])->name('about.state-service-regulations');
    
    // Государственные символы
    Route::get('/about/state-symbols/flag', [AboutController::class, 'stateFlag'])->name('about.state-flag');
    Route::get('/about/state-symbols/emblem', [AboutController::class, 'stateEmblem'])->name('about.state-emblem');
    Route::get('/about/state-symbols/anthem', [AboutController::class, 'stateAnthem'])->name('about.state-anthem');
    
    Route::get('/about/paid-services', [AboutController::class, 'paidServices'])->name('about.paid-services');
    
    // Комплаенс служба
    Route::get('/about/compliance-service/officer-plan', [AboutController::class, 'complianceOfficerPlan'])->name('about.compliance-officer-plan');
    Route::get('/about/compliance-service/corruption-risk-analysis', [AboutController::class, 'corruptionRiskAnalysis'])->name('about.corruption-risk-analysis');
    Route::get('/about/compliance-service/internal-regulations', [AboutController::class, 'internalRegulations'])->name('about.internal-regulations');
    
    // Картограмма коррупции
    Route::get('/about/corruption-risk-map/positions', [AboutController::class, 'corruptionRiskPositions'])->name('about.corruption-risk-positions');
    Route::get('/about/corruption-risk-map/list', [AboutController::class, 'corruptionRiskList'])->name('about.corruption-risk-list');
    Route::get('/about/corruption-risk-map/map', [AboutController::class, 'corruptionRiskMap'])->name('about.corruption-risk-map');
    
    // Новости (через blade views)
    Route::get('/news', [FrontendController::class, 'newsList'])->name('news.list');
    Route::get('/news/{slug}', [FrontendController::class, 'newsDetail'])->name('news.detail');
    
    // Подстанции
    Route::get('/substations', [SubstationController::class, 'index'])->name('substations.index');
    Route::get('/substations/{id}', [SubstationController::class, 'show'])->name('substations.show');
    
    // Блог о директоре
    Route::get('/director-blog', [DirectorBlogController::class, 'show'])->name('director-blog.show');
    
    // Антикор
    Route::get('/anticorruption', [AnticorruptionController::class, 'show'])->name('anticorruption.show');
    
    // Миссия скорой помощи
    Route::get('/mission-of-emergency-service', [MissionOfEmergencyServiceController::class, 'show'])->name('mission-of-emergency-service.show');
    
    // ЗОЖ
    Route::get('/healthy-lifestyle', [HealthyLifestyleController::class, 'show'])->name('healthy-lifestyle.show');
});

