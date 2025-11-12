<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About;

use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Resources\About\Pages\AdministrationPage;
use App\MoonShine\Resources\About\Pages\SchedulePage;
use App\MoonShine\Resources\About\Pages\StructurePage;
use App\MoonShine\Resources\About\Pages\MissionPage;
use App\MoonShine\Resources\About\Pages\EthicalCodePage;
use App\MoonShine\Resources\About\Pages\IncomeExpensePage;
use App\Models\Setting;

class AboutResource extends ModelResource
{
    protected string $model = Setting::class; // Используем Setting как заглушку для модели
    protected string $title = 'О нас';

    /**
     * Используем GuestLayout для публичных страниц
     */
    protected function getLayout(): string
    {
        return \App\MoonShine\Layouts\GuestLayout::class;
    }

    /**
     * @return list<class-string<\MoonShine\Contracts\Core\PageContract>>
     */
    protected function pages(): array
    {
        return [
            AdministrationPage::class,
            SchedulePage::class,
            StructurePage::class,
            MissionPage::class,
            EthicalCodePage::class,
            IncomeExpensePage::class,
        ];
    }
}

