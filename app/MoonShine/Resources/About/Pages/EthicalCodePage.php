<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\EthicalCode;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;

#[SkipMenu]
class EthicalCodePage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Этический кодекс';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/ethical-code' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $ethicalCodes = EthicalCode::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (EthicalCode $item) {
                $item->pdf_url = $item->pdf_path
                    ? Storage::disk('public')->url($item->pdf_path)
                    : null;
            });

        return [
            Box::make('Этический кодекс', [
                Heading::make('Этический кодекс'),
                // Здесь можно добавить компоненты для отображения этического кодекса
            ]),
        ];
    }
}

