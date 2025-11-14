<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\ComplianceOfficerPlan;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\FlexibleRender;
use Illuminate\Support\Facades\Storage;

#[SkipMenu]
class ComplianceOfficerPlanPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'План работы комплаенс офицера 2024г';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/compliance-service/officer-plan' => $this->getTitle()
        ];
    }

    protected function components(): iterable
    {
        $plans = ComplianceOfficerPlan::query()
            ->orderBy('created_at', 'desc')
            ->get()
            ->each(function (ComplianceOfficerPlan $item) {
                $item->file_url = $item->file_path
                    ? Storage::disk('public')->url($item->file_path)
                    : null;
            });

        $containerComponents = [];
        
        foreach ($plans as $plan) {
            if ($plan->file_url) {
                $containerComponents[] = FlexibleRender::make(
                    '<div style="margin-bottom: 2rem;">
                        <h3 style="margin-bottom: 1rem; font-size: 1.25rem; font-weight: 600; color: #212529;">' . e($plan->title) . '</h3>
                        <div style="position: relative; width: 100%; height: 800px; border: 1px solid #dee2e6; border-radius: 0.375rem; overflow: hidden; background-color: #f8f9fa;">
                            <iframe
                                src="' . e($plan->file_url) . '#toolbar=1&navpanes=1&scrollbar=1"
                                width="100%"
                                height="100%"
                                style="border: none;"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>'
                );
            }
        }

        if (empty($containerComponents)) {
            $containerComponents[] = Text::make('Информация пока не добавлена')
                ->readonly();
        }

        return [
            Box::make('План работы комплаенс офицера 2024г', $containerComponents),
        ];
    }
}

