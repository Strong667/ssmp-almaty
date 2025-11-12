<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Home\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\Setting;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\Layout\Div;
use Illuminate\Support\Facades\View;

#[SkipMenu]
class HomePage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Главная';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $images = Setting::query()
            ->whereNotNull('main_image')
            ->orderByDesc('updated_at')
            ->get()
            ->map(fn (Setting $setting) => [
                'id' => $setting->id,
                'url' => Storage::disk('public')->url($setting->main_image),
            ]);

        $news = News::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get()
            ->each(function (News $item) {
                $item->image_url = $item->image
                    ? Storage::disk('public')->url($item->image)
                    : null;
            });

        $newsHtml = View::make('moonshine.home.news', ['news' => $news])->render();

        return [
            Box::make('Главная страница', [
                Heading::make('Добро пожаловать'),
                Div::make([$newsHtml])
                    ->customAttributes(['class' => 'news-wrapper']),
            ]),
        ];
    }
}

