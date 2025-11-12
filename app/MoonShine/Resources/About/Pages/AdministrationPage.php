<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\Admin;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;

#[SkipMenu]
class AdministrationPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Администрация';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/administration' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $admins = Admin::query()
            ->orderBy('full_name')
            ->get();

        return [
            Box::make('Администрация', [
                Heading::make('Администрация'),
                // Здесь можно добавить компоненты для отображения списка администрации
            ]),
        ];
    }
}

