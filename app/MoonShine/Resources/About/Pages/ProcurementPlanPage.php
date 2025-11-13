<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\ProcurementPlan;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\Link;

#[SkipMenu]
class ProcurementPlanPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'План государственных закупок';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/procurement-plan' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $plans = ProcurementPlan::query()
            ->orderByDesc('year')
            ->get();

        $containerComponents = [];

        if ($plans->isNotEmpty()) {
            foreach ($plans as $plan) {
                if ($plan->file_url) {
                    // Текст как кликабельная ссылка, открывается в браузере (без download)
                    $containerComponents[] = Box::make('План государственных закупок', [
                        Link::make($plan->file_url, $plan->title)
                            ->customAttributes(['target' => '_blank']),
                    ]);
                } else {
                    $containerComponents[] = Box::make('План государственных закупок', [
                        Text::make($plan->title)
                            ->readonly(),
                        Text::make('Файл не загружен')
                            ->readonly(),
                    ]);
                }
            }
        } else {
            $containerComponents[] = Box::make('План государственных закупок', [
                Text::make('Планы закупок пока не добавлены')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('План государственных закупок', $containerComponents),
        ];
    }
}

