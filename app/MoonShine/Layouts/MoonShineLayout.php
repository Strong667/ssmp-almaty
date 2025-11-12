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
use App\MoonShine\Resources\SettingResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\NewsResource;
use MoonShine\MenuManager\MenuGroup;
use App\MoonShine\Resources\AdminResource;
use App\MoonShine\Resources\CitizenScheduleResource;
use App\MoonShine\Resources\StructureResource;
use App\MoonShine\Resources\MissionValueResource;

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
                MenuItem::make('Settings', SettingResource::class),
                MenuItem::make('News', NewsResource::class),
            ]),
            MenuGroup::make('О нас', [
                MenuItem::make('Администрация', AdminResource::class),
                MenuItem::make('График приёма граждан', CitizenScheduleResource::class),
                MenuItem::make('Структура', StructureResource::class),
                MenuItem::make('Миссия и ценности', MissionValueResource::class),
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
