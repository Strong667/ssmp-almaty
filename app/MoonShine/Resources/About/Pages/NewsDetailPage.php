<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Components\FlexibleRender;

#[SkipMenu]
class NewsDetailPage extends Page
{

    public function getTitle(): string
    {
        return 'Новость';
    }

    public function getBreadcrumbs(): array
    {
        $slug = request()->route('slug');
        $news = News::query()->where('slug', $slug)->first();
        
        $breadcrumbs = [
            '/' => 'Главная',
            route('news.list') => 'Новости',
        ];
        
        if ($news && $news->slug) {
            $breadcrumbs[route('news.detail', $news->slug)] = $news->title;
        }
        
        return $breadcrumbs;
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $slug = request()->route('slug');
        
        $news = News::query()
            ->where('slug', $slug)
            ->first();

        if (!$news) {
            return [
                Box::make('Новость не найдена', [
                    Text::make('Запрашиваемая новость не существует')
                        ->readonly(),
                ]),
            ];
        }

        $imageUrl = $news->image
            ? Storage::disk('public')->url($news->image)
            : null;

        $containerComponents = [];

        // Изображение
        if ($imageUrl) {
            $containerComponents[] = FlexibleRender::make(
                '<div style="width: 100%; margin-bottom: 1.5rem;">
                    <img src="' . e($imageUrl) . '" alt="' . e($news->title) . '" style="width: 100%; height: auto; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                </div>'
            );
        }

        // Основная информация
        $newsFields = [
            ID::make()->fillData(['id' => $news->id], 0),
            Text::make('Название', 'title')
                ->fillData(['title' => $news->title], 0)
                ->readonly(),
            Text::make('Дата добавления', 'display_date')
                ->fillData(['display_date' => $news->display_date], 0)
                ->readonly(),
        ];

        $containerComponents[] = Box::make('Информация о новости', $newsFields);

        // Описание
        if ($news->description) {
            $containerComponents[] = FlexibleRender::make(
                '<div style="margin-bottom: 1.5rem;">
                    <div style="font-size: 1rem; line-height: 1.6; color: #495057; white-space: pre-wrap;">
                        ' . nl2br(e($news->description)) . '
                    </div>
                </div>'
            );
        }

        // Видео, если есть
        if ($news->video_url) {
            $containerComponents[] = FlexibleRender::make(
                '<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 1.5rem;">
                    <iframe
                        width="100%"
                        height="100%"
                        src="' . e($news->video_url) . '"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                    </iframe>
                </div>'
            );
        }

        return [
            Box::make($news->title, $containerComponents),
        ];
    }
}

