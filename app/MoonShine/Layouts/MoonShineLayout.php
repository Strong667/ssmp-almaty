<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

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
    When};
use App\MoonShine\Resources\Setting\SettingResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\News\NewsResource;
use MoonShine\MenuManager\MenuGroup;
use App\MoonShine\Resources\Admin\AdminResource;
use App\MoonShine\Resources\CitizenSchedule\CitizenScheduleResource;
use App\MoonShine\Resources\Structure\StructureResource;
use App\MoonShine\Resources\MissionValue\MissionValueResource;

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
            ]),
            MenuGroup::make('О нас', [
                MenuItem::make(AdminResource::class, 'Администрация'),
                MenuItem::make(CitizenScheduleResource::class, 'График приёма граждан'),
                MenuItem::make(StructureResource::class, 'Структура'),
                MenuItem::make(MissionValueResource::class, 'Миссия и ценности'),
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
