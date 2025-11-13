<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Home\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\News;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\CardsBuilder;
use MoonShine\UI\Components\FlexibleRender;

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
        $news = News::query()
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get()
            ->each(function (News $item) {
                $item->image_url = $item->image
                    ? Storage::disk('public')->url($item->image)
                    : null;
            });

        // Подготавливаем данные для CardsBuilder
        $newsData = $news->map(function (News $item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'thumbnail' => $item->image_url,
                'date' => $item->display_date,
                'slug' => $item->slug ?? '#',
            ];
        })->toArray();

        // Получаем картинки из Settings для слайдера
        $settingsImages = Setting::query()
            ->whereNotNull('main_image')
            ->orderByDesc('updated_at')
            ->get()
            ->map(function (Setting $setting) {
                return Storage::disk('public')->url($setting->main_image);
            })
            ->toArray();

        // Подготавливаем компоненты для единого контейнера
        $containerComponents = [];

        // Добавляем новости
        if ($news->isNotEmpty()) {
            $containerComponents[] = CardsBuilder::make($newsData, [])
                ->thumbnail(fn ($data) => $data['thumbnail'] ?? '')
                ->title(fn ($data) => $data['title'] ?? '')
                ->subtitle('')  // Убираем subtitle
                ->content(function ($data) {
                    $slug = $data['slug'] ?? null;
                    $newsDetailUrl = $slug && $slug !== '#' ? route('news.detail', $slug) : '#';
                    return '<div style="padding: 1rem; display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-size: 0.875rem; color: #6c757d;">' . e($data['date'] ?? '') . '</div>
                        <a href="' . e($newsDetailUrl) . '" style="color: #1977cc; text-decoration: none; font-size: 0.875rem; transition: color 0.3s;" onmouseover="this.style.color=\'#0d5aa7\'" onmouseout="this.style.color=\'#1977cc\'">
                            Читать новости →
                        </a>
                    </div>';
                })
                ->componentAttributes(fn ($data) => [
                    'style' => 'height: 380px; display: flex; flex-direction: column; overflow: hidden;',
                    'class' => 'news-card'
                ])
                ->columnSpan(4);  // 3 карточки в ряд (12/4=3)
        } else {
            $containerComponents[] = Text::make('Новостей пока нет')
                ->readonly();
        }

        // Добавляем YouTube видео между новостями и галереей
        $containerComponents[] = FlexibleRender::make(
            '<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <iframe
                    width="100%"
                    height="100%"
                    src="https://www.youtube.com/embed/videoseries?list=PLsaGgmCCSu8VucnlqRDRA-637FOrsBy1o"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                </iframe>
            </div>'
        );

        // Добавляем карту Yandex после видео
        $containerComponents[] = FlexibleRender::make(
            '<div style="position: relative; width: 100%; height: 500px; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <iframe
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3A984a0c4f628d41f0563e1e4becea1dd9bfe4ad7ec66d31d1ad0418b2232d4e74&source=constructor"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>'
        );

        // Добавляем галерею, если есть картинки
        if (!empty($settingsImages)) {
            $sliderId = 'image-slider-' . uniqid();
            // Создаем слайды с отступами по бокам (широкие по горизонтали)
            $slidesHtml = implode('', array_map(function ($imageUrl, $index) {
                return '<div class="slide-item" style="flex: 0 0 auto; margin: 0 15px; width: 500px; height: 300px; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <img src="' . e($imageUrl) . '" alt="Изображение ' . ($index + 1) . '" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                </div>';
            }, $settingsImages, array_keys($settingsImages)));

            // Дублируем картинки для бесшовной прокрутки
            $duplicatedSlidesHtml = $slidesHtml . $slidesHtml;

            $containerComponents[] = FlexibleRender::make(
                '<div id="' . $sliderId . '" style="position: relative; width: 100%; overflow: hidden; padding: 20px 0;">
                    <div class="slider-wrapper" style="overflow: hidden;">
                        <div class="slider-container" style="display: flex; width: fit-content; animation: scroll 30s linear infinite;">
                            ' . $duplicatedSlidesHtml . '
                        </div>
                    </div>
                </div>
                <style>
                    @keyframes scroll {
                        0% {
                            transform: translateX(0);
                        }
                        100% {
                            transform: translateX(-50%);
                        }
                    }
                    #' . $sliderId . ':hover .slider-container {
                        animation-play-state: paused;
                    }
                    #' . $sliderId . ' .slide-item {
                        transition: transform 0.3s ease;
                    }
                    #' . $sliderId . ' .slide-item:hover {
                        transform: scale(1.05);
                    }
                </style>'
            );
        }

        return [
            // Единый контейнер для новостей и галереи
            Box::make('Главная', $containerComponents),
        ];
    }
}

