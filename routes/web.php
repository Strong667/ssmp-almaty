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
});

