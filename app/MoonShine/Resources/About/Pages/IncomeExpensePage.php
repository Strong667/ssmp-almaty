<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\IncomeExpenseReport;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\Table\TableBuilder;

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
            ->get();

        return [
            Box::make('Отчёты о доходах и расходах', [
                $reports->isNotEmpty()
                    ? TableBuilder::make(
                        [
                            ID::make()->sortable(),
                            Text::make('Название', 'title')->sortable(),
                            Text::make('Описание', 'description'),
                            File::make('Файл', 'file_path')
                                ->disk('public'),
                        ],
                        $reports
                    )
                    : Text::make('Отчёты о доходах и расходах пока не добавлены')
                        ->readonly(),
            ]),
        ];
    }
}

