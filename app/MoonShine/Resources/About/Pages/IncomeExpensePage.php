<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\IncomeExpenseReport;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;

#[SkipMenu]
class IncomeExpensePage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Отчёты о доходах и расходах';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/income-expense' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $reports = IncomeExpenseReport::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (IncomeExpenseReport $item) {
                $item->file_url = $item->file_path
                    ? Storage::disk('public')->url($item->file_path)
                    : null;
            });

        return [
            Box::make('Отчёты о доходах и расходах', [
                Heading::make('Отчёты о доходах и расходах'),
                // Здесь можно добавить компоненты для отображения отчётов
            ]),
        ];
    }
}

