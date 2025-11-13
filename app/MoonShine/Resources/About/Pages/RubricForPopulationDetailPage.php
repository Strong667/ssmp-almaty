<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\RubricForPopulation;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Components\FlexibleRender;

#[SkipMenu]
class RubricForPopulationDetailPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Рубрика для населения';
    }

    public function getBreadcrumbs(): array
    {
        $breadcrumbs = [
            '/' => 'Главная',
            route('about.rubric-for-population') => 'Рубрика для населения',
        ];
        
        $rubric = RubricForPopulation::find(request()->route('id'));
        if ($rubric) {
            $breadcrumbs[route('about.rubric-for-population.detail', $rubric->id)] = $rubric->title;
        }
        
        return $breadcrumbs;
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $id = request()->route('id');
        $item = RubricForPopulation::find($id);

        if (!$item) {
            return [
                Box::make('Ошибка', [
                    Text::make('Рубрика не найдена')
                        ->readonly(),
                ]),
            ];
        }

        $containerComponents = [];

        // Название
        $containerComponents[] = Box::make('', [
            ID::make()->fillData(['id' => $item->id], 0),
            Text::make('Название', 'title')
                ->fillData(['title' => $item->title], 0)
                ->readonly(),
        ]);

        // Основное изображение
        if ($item->image) {
            $imageUrl = $item->image_url;
            $containerComponents[] = FlexibleRender::make(
                '<div style="width: 100%; margin-bottom: 1.5rem;">
                    <img src="' . e($imageUrl) . '" alt="' . e($item->title) . '" style="width: 100%; height: auto; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                </div>'
            );
        }

        // Описание
        if ($item->description) {
            $containerComponents[] = Box::make('', [
                Textarea::make('Описание', 'description')
                    ->fillData(['description' => $item->description], 0)
                    ->readonly()
                    ->customAttributes(['rows' => 5]),
            ]);
        }

        // Контент в зависимости от типа
        switch ($item->type) {
            case 'text':
                if ($item->content) {
                    $containerComponents[] = FlexibleRender::make(
                        '<div style="margin-bottom: 1.5rem;">
                            <div style="font-size: 1rem; line-height: 1.6; color: var(--moonshine-text, #374151); white-space: pre-wrap;">
                                ' . nl2br(e($item->content)) . '
                            </div>
                        </div>'
                    );
                }
                break;

            case 'pdf':
                if ($item->file_path) {
                    $fileUrl = $item->file_url;
                    $containerComponents[] = FlexibleRender::make(
                        '<div style="margin-bottom: 1.5rem;">
                            <div style="position: relative; width: 100%; padding-bottom: 120%; height: 0; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <iframe
                                    width="100%"
                                    height="100%"
                                    src="' . e($fileUrl) . '#toolbar=1&navpanes=1&scrollbar=1"
                                    frameborder="0"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                </iframe>
                            </div>
                        </div>'
                    );
                }
                break;

            case 'video':
                if ($item->content) {
                    $embedUrl = $this->convertYoutubeUrlToEmbed(trim($item->content));
                    if ($embedUrl) {
                        $containerComponents[] = FlexibleRender::make(
                            '<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 1.5rem;">
                                <iframe
                                    width="100%"
                                    height="100%"
                                    src="' . e($embedUrl) . '"
                                    frameborder="0"
                                    allow="autoplay; encrypted-media"
                                    allowfullscreen
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                </iframe>
                            </div>'
                        );
                    } else {
                        // Если не удалось преобразовать URL, показываем сообщение об ошибке
                        $containerComponents[] = FlexibleRender::make(
                            '<div style="margin-bottom: 1.5rem; padding: 1rem; background-color: #fee2e2; border: 1px solid #fecaca; border-radius: 0.375rem; color: #991b1b;">
                                <p>Не удалось загрузить видео. Проверьте правильность URL: ' . e($item->content) . '</p>
                            </div>'
                        );
                    }
                }
                break;

            case 'images':
                if ($item->file_path) {
                    $imageUrl = $item->file_url;
                    $containerComponents[] = FlexibleRender::make(
                        '<div style="width: 100%; margin-bottom: 1.5rem;">
                            <img src="' . e($imageUrl) . '" alt="Изображение" style="width: 100%; height: auto; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        </div>'
                    );
                }
                break;
        }

        return [
            Box::make('', $containerComponents),
        ];
    }

    /**
     * Преобразует URL YouTube в embed формат
     *
     * @param string $url
     * @return string|null
     */
    private function convertYoutubeUrlToEmbed(string $url): ?string
    {
        $url = trim($url);
        
        // Проверяем различные форматы YouTube URL
        // https://www.youtube.com/watch?v=VIDEO_ID или http://www.youtube.com/watch?v=VIDEO_ID
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // https://youtu.be/VIDEO_ID или http://youtu.be/VIDEO_ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // https://www.youtube.com/embed/VIDEO_ID (уже в правильном формате)
        if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $url;
        }
        
        // Проверяем короткие ссылки без протокола
        if (preg_match('/^youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // Если URL уже содержит embed, возвращаем как есть
        if (strpos($url, 'youtube.com/embed/') !== false) {
            return $url;
        }
        
        return null;
    }
}

