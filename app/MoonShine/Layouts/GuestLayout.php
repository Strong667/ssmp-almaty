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
use MoonShine\UI\Components\Link;
use Illuminate\Support\Facades\Route;

final class GuestLayout extends AppLayout
{
    protected bool $contentCentered = true;
    protected bool $contentSimpled = true;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        // Для публичных страниц меню не нужно
        return [];
    }

    /**
     * Переопределяем TopBar для публичных страниц с навигацией
     */
    protected function getTopBarComponent(): TopBar
    {
        return TopBar::make([
            Fragment::make([
                $this->getLogoComponent(),
            ])->class('menu-logo')->name('topbar-logo'),

            Fragment::make([
                // Публичное меню навигации
                Link::make(route('home'),'Главная')
                    ->icon('home')
                    ->when(
                        fn (): bool => Route::currentRouteName() === 'home',
                        fn (Link $link): Link => $link->customAttributes(['class' => 'active'])
                    ),
                Link::make('about', 'О нас')
                    ->icon('information-circle')
                    ->when(
                        fn (): bool => str_starts_with(Route::currentRouteName() ?? '', 'about.'),
                        fn (Link $link): Link => $link->customAttributes(['class' => 'active'])
                    ),
                // Можно добавить больше пунктов меню здесь
            ])->class('menu menu--horizontal')->name('topbar-menu'),

            Fragment::make([
                ...$this->topBarSlot(),
                // Переключатель темы для гостей
                When::make(
                    fn (): bool => $this->hasThemes() && ! $this->isAlwaysDark(),
                    static fn (): array => [ThemeSwitcher::make()]
                ),
            ])->class('menu menu--horizontal menu--end')->name('topbar-actions'),
        ]);
    }

    /**
     * Слот для дополнительных элементов TopBar
     */
    protected function topBarSlot(): array
    {
        return [];
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
        return Layout::make([
            Html::make([
                $this->getHeadComponent(),
                Body::make([
                    Wrapper::make([
                        $this->getTopBarComponent(),

                        Div::make([
                            Fragment::make([
                                Flash::make(),

                                Content::make($this->getContentComponents()),

                                $this->getFooterComponent(),
                            ])->class(['layout-page', 'layout-page-simple' => $this->contentSimpled])->name(self::CONTENT_FRAGMENT_NAME),
                        ])->class(['layout-main', 'layout-main-centered' => $this->contentCentered])->customAttributes(['id' => self::CONTENT_ID]),
                    ]),
                ]),
            ])
                ->customAttributes([
                    'lang' => $this->getHeadLang(),
                ])
                ->withAlpineJs()
                ->when(
                    $this->hasThemes() || $this->isAlwaysDark(),
                    fn (Html $html): Html => $html->withThemes($this->isAlwaysDark())
                ),
        ]);
    }
}
