<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\PaidService;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\CardsBuilder;
use Illuminate\Support\Facades\Storage;

#[SkipMenu]
class PaidServicesPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Платные услуги';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/paid-services' => $this->getTitle()
        ];
    }

    protected function components(): iterable
    {
        $services = PaidService::query()->orderBy('created_at', 'desc')->get();

        if ($services->isEmpty()) {
            return [
                Box::make('Платные услуги', [
                    Text::make('Информация пока не добавлена')
                        ->readonly(),
                ]),
            ];
        }

        return [
            CardsBuilder::make($services->toArray(), [])
                ->thumbnail(fn ($data) => $data['image'] ? Storage::disk('public')->url($data['image']) : '')
                ->title('')
                ->subtitle('')
                ->content('')
                ->componentAttributes(fn ($data) => [
                    'style' => 'height: auto; min-height: 250px; display: flex; flex-direction: column; overflow: hidden;',
                ])
                ->columnSpan(4),
        ];
    }
}

