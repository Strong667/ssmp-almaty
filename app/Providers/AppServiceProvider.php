<?php

namespace App\Providers;

use App\MoonShine\Resources\Admin\AdminResource;
use App\MoonShine\Resources\CitizenSchedule\CitizenScheduleResource;
use App\MoonShine\Resources\EthicalCode\EthicalCodeResource;
use App\MoonShine\Resources\IncomeExpenseReport\IncomeExpenseReportResource;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use App\MoonShine\Resources\News\NewsResource;
use App\MoonShine\Resources\Setting\SettingResource;
use App\MoonShine\Resources\Structure\StructureResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        // Устанавливаем локаль через View Composer перед рендерингом каждого view
        // Это гарантирует, что локаль установлена до того, как Blade начнет рендерить переводы
        View::composer('*', function ($view) {
            // Получаем локаль из сессии или используем дефолтную
            $locale = Session::has('locale') ? Session::get('locale') : config('app.locale');
            
            // Устанавливаем локаль
            App::setLocale($locale);
            
            // Сохраняем локаль в сессии для следующего запроса, если еще не сохранена
            if (!Session::has('locale')) {
                Session::put('locale', $locale);
            }
        });

        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                SettingResource::class,
                NewsResource::class,
                AdminResource::class,
                CitizenScheduleResource::class,
                StructureResource::class,
                EthicalCodeResource::class,
                IncomeExpenseReportResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
