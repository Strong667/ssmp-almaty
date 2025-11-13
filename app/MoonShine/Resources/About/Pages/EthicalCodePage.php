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
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\FlexibleRender;

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

        $containerComponents = [];
        
        foreach ($ethicalCodes as $ethicalCode) {
            if ($ethicalCode->pdf_url) {
                $containerComponents[] = FlexibleRender::make(
                    '<div style="margin-bottom: 2rem;">
                        <h3 style="margin-bottom: 1rem; font-size: 1.25rem; font-weight: 600; color: #212529;">' . e($ethicalCode->title) . '</h3>
                        <div style="position: relative; width: 100%; height: 800px; border: 1px solid #dee2e6; border-radius: 0.375rem; overflow: hidden; background-color: #f8f9fa;">
                            <iframe
                                src="' . e($ethicalCode->pdf_url) . '#toolbar=1&navpanes=1&scrollbar=1"
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
            $containerComponents[] = Text::make('Этический кодекс пока не добавлен')
                ->readonly();
        }

        return [
            Box::make('Этический кодекс', $containerComponents),
        ];
    }
}

