<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\CorruptionRiskMap;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\FlexibleRender;
use Illuminate\Support\Facades\Storage;

#[SkipMenu]
class CorruptionRiskMapPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Карта коррупционных рисков';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/corruption-risk-map/map' => $this->getTitle()
        ];
    }

    protected function components(): iterable
    {
        $maps = CorruptionRiskMap::query()
            ->orderBy('created_at', 'desc')
            ->get()
            ->each(function (CorruptionRiskMap $item) {
                $item->file_url = $item->file_path
                    ? Storage::disk('public')->url($item->file_path)
                    : null;
            });

        if ($maps->isEmpty()) {
            return [
                Box::make('Карта коррупционных рисков', [
                    Text::make('Информация пока не добавлена')
                        ->readonly(),
                ]),
            ];
        }

        $linksHtml = '<ul style="list-style: none; padding: 0; margin: 0;">';
        foreach ($maps as $map) {
            if ($map->file_url) {
                $linksHtml .= '<li style="margin-bottom: 1rem; padding: 0.75rem; border-bottom: 1px solid #dee2e6;">';
                $linksHtml .= '<a href="' . e($map->file_url) . '" target="_blank" style="color: #1977cc; text-decoration: none; font-size: 1rem; font-weight: 500; display: inline-flex; align-items: center; gap: 0.5rem; transition: color 0.2s;" onmouseover="this.style.color=\'#0d5aa7\'" onmouseout="this.style.color=\'#1977cc\'">';
                $linksHtml .= '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>';
                $linksHtml .= e($map->title);
                $linksHtml .= '</a>';
                $linksHtml .= '</li>';
            }
        }
        $linksHtml .= '</ul>';

        return [
            Box::make('Карта коррупционных рисков', [
                FlexibleRender::make($linksHtml),
            ]),
        ];
    }
}

