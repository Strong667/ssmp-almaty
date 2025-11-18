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
