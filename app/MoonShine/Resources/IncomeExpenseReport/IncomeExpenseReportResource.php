<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\IncomeExpenseReport;

use App\Models\IncomeExpenseReport;
use App\MoonShine\Resources\IncomeExpenseReport\Pages\IncomeExpenseReportIndexPage;
use App\MoonShine\Resources\IncomeExpenseReport\Pages\IncomeExpenseReportFormPage;
use App\MoonShine\Resources\IncomeExpenseReport\Pages\IncomeExpenseReportDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<IncomeExpenseReport, IncomeExpenseReportIndexPage, IncomeExpenseReportFormPage, IncomeExpenseReportDetailPage>
 */
class IncomeExpenseReportResource extends ModelResource
{
    protected string $model = IncomeExpenseReport::class;

    protected string $title = 'Отчёты о доходах и расходах';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            IncomeExpenseReportIndexPage::class,
            IncomeExpenseReportFormPage::class,
            IncomeExpenseReportDetailPage::class,
        ];
    }
}
