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
use MoonShine\UI\Components\Dropdown;
use MoonShine\UI\Components\Icon;
use MoonShine\UI\Components\FlexibleRender;
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
     * Переопределяем логотип для использования slujba.png
     */
    protected function getLogoComponent(): Logo
    {
        return Logo::make(
            $this->getHomeUrl(),
            asset('slujba.png'),
            asset('slujba.png'),
        );
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
                // Дропдаун меню "О нас" с подстраницами (стилизованный как в админ-панели)
                Dropdown::make()
                    ->toggler(
                        '<div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; transition: all 0.2s; ' .
                        (in_array(Route::currentRouteName() ?? '', [
                            'about.administration',
                            'about.schedule',
                            'about.structure',
                            'about.mission',
                            'about.ethical-code',
                            'about.income-expense',
                            'about.vacancy-employment',
                            'about.documents',
                            'about.activity-sphere'
                        ]) ? 'background-color: rgba(139, 92, 246, 0.1); color: rgb(139, 92, 246);' : '') .
                        '">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1rem; height: 1rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            <span>О нас</span>
                        </div>'
                    )
                    ->items([
                        Link::make(route('about.administration'), 'Администрация')
                            ->icon('users'),
                        Link::make(route('about.schedule'), 'График приёма граждан')
                            ->icon('calendar-days'),
                        Link::make(route('about.structure'), 'Структура')
                            ->icon('building-office'),
                        Link::make(route('about.mission'), 'Миссия и ценности')
                            ->icon('star'),
                        Link::make(route('about.ethical-code'), 'Этический кодекс')
                            ->icon('document-text'),
                        Link::make(route('about.income-expense'), 'Отчёты о доходах и расходах')
                            ->icon('chart-bar'),
                        Link::make(route('about.vacancy-employment'), 'Вакансия')
                            ->icon('briefcase'),
                        Link::make(route('about.documents'), 'Документы')
                            ->icon('folder'),
                        Link::make(route('about.activity-sphere'), 'Сфера деятельности')
                            ->icon('building-office-2'),
                    ])
                    ->placement('bottom-start'),
                // Дропдаун меню "Государственные закупки"
                Dropdown::make()
                    ->toggler(
                        '<div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; transition: all 0.2s; ' .
                        (in_array(Route::currentRouteName() ?? '', ['about.procurement-plan', 'about.announcements', 'about.protocols']) ? 'background-color: rgba(139, 92, 246, 0.1); color: rgb(139, 92, 246);' : '') .
                        '">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1rem; height: 1rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                            <span>Государственные закупки</span>
                        </div>'
                    )
                    ->items([
                        Link::make(route('about.procurement-plan'), 'План государственных закупок')
                            ->icon('document-arrow-down'),
                        Link::make(route('about.announcements'), 'Объявления')
                            ->icon('megaphone'),
                        Link::make(route('about.protocols'), 'Протоколы')
                            ->icon('document-check'),
                    ])
                    ->placement('bottom-start'),
                // Ссылка на новости
                Link::make(route('news.list'), 'Новости')
                    ->icon('newspaper')
                    ->when(
                        fn (): bool => Route::currentRouteName() === 'news.list' || Route::currentRouteName() === 'news.detail',
                        fn (Link $link): Link => $link->customAttributes(['class' => 'active'])
                    ),
                // Дропдаун меню "Жителям Алматы"
                Dropdown::make()
                    ->toggler(
                        '<div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; transition: all 0.2s; ' .
                        (in_array(Route::currentRouteName() ?? '', ['about.medical-help-for-foreigners', 'about.legal-framework', 'about.emergency-service-rules', 'about.social-insurance', 'about.rubric-for-population']) ? 'background-color: rgba(139, 92, 246, 0.1); color: rgb(139, 92, 246);' : '') .
                        '">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1rem; height: 1rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <span>Жителям Алматы</span>
                        </div>'
                    )
                    ->items([
                        Link::make(route('about.medical-help-for-foreigners'), 'Оказание медицинской помощи иностранному гражданину в РК')
                            ->icon('globe-alt'),
                        Link::make(route('about.legal-framework'), 'Нормативно-правовая база')
                            ->icon('document-text'),
                        Link::make(route('about.emergency-service-rules'), 'Правила обращения в службу скорой медицинской помощи')
                            ->icon('phone'),
                        Link::make(route('about.social-insurance'), 'Обязательное социальное медицинское страхование')
                            ->icon('shield-check'),
                        Link::make(route('about.rubric-for-population'), 'Рубрика для населения')
                            ->icon('newspaper'),
                    ])
                    ->placement('bottom-start'),
                // Можно добавить больше пунктов меню здесь
            ])->class('menu menu--horizontal')->name('topbar-menu'),

            Fragment::make([
                ...$this->topBarSlot(),
                // Кнопка расширения контейнера (стилизована как переключатель темы)
                FlexibleRender::make(
                    '<button
                        id="expand-container-btn"
                        type="button"
                        onclick="toggleContainerExpand()"
                        title="Расширить контейнер">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                        </svg>
                    </button>'
                ),
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
                    // Глобальные стили и скрипты для расширения контейнера
                    FlexibleRender::make(
                        '<style>
                            /* Стили применяются только когда body имеет класс container-expanded */
                            body.container-expanded .layout-main-centered {
                                max-width: 100% !important;
                                padding-left: 1rem;
                                padding-right: 1rem;
                            }
                            body.container-expanded .layout-page {
                                max-width: 100% !important;
                            }
                            body.container-expanded [data-page-content] {
                                max-width: 100% !important;
                                width: 100% !important;
                            }

                            /* Стилизация кнопки расширения как переключателя темы */
                            #expand-container-btn {
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                width: 2rem;
                                height: 2rem;
                                padding: 0;
                                margin: 0;
                                border: none;
                                background-color: transparent;
                                color: currentColor;
                                cursor: pointer;
                                transition: all 0.2s;
                                border-radius: 0.375rem;
                            }

                            #expand-container-btn:hover {
                                background-color: rgba(255, 255, 255, 0.1);
                            }

                            #expand-container-btn svg {
                                width: 1rem;
                                height: 1rem;
                            }

                            /* Выравнивание кнопок в одном контейнере */
                            .menu--end {
                                display: flex !important;
                                align-items: center !important;
                                gap: 0.5rem !important;
                            }

                            /* Убираем рамку и выравниваем FlexibleRender */
                            .menu--end > * {
                                display: inline-flex;
                                align-items: center;
                                vertical-align: middle;
                            }
                        </style>
                        <script>
                            function toggleContainerExpand() {
                                const isExpanded = localStorage.getItem("containerExpanded") === "true";
                                const newState = !isExpanded;
                                localStorage.setItem("containerExpanded", newState);
                                applyContainerExpand(newState);
                            }

                            function applyContainerExpand(expanded) {
                                const btn = document.getElementById("expand-container-btn");
                                if (!btn) return;

                                if (expanded) {
                                    // Расширенное состояние - показываем иконку "свернуть" (внутренние стрелки)
                                    document.body.classList.add("container-expanded");
                                    btn.querySelector("svg path").setAttribute("d", "M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25");
                                    btn.setAttribute("title", "Свернуть контейнер");
                                } else {
                                    // Свернутое состояние - показываем иконку "расширить" (внешние стрелки)
                                    document.body.classList.remove("container-expanded");
                                    btn.querySelector("svg path").setAttribute("d", "M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15");
                                    btn.setAttribute("title", "Расширить контейнер");
                                }
                            }

                            // Применяем сохраненное состояние при загрузке страницы
                            document.addEventListener("DOMContentLoaded", function() {
                                const isExpanded = localStorage.getItem("containerExpanded") === "true";
                                applyContainerExpand(isExpanded);
                            });
                        </script>'
                    ),
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
