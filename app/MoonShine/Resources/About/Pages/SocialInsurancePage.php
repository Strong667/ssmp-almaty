<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\SocialInsurance;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\FlexibleRender;

#[SkipMenu]
class SocialInsurancePage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Обязательное социальное медицинское страхование';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/social-insurance' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $items = SocialInsurance::query()
            ->orderBy('order')
            ->orderBy('created_at')
            ->get();

        $containerComponents = [];

        if ($items->isNotEmpty()) {
            foreach ($items as $item) {
                $blockComponent = null;

                switch ($item->type) {
                    case 'text':
                        if ($item->content) {
                            $blockComponent = FlexibleRender::make(
                                '<div style="margin-bottom: 1.5rem;">
                                    <div style="font-size: 1rem; line-height: 1.6; color: var(--moonshine-text, #374151); white-space: pre-wrap;">
                                        ' . nl2br(e($item->content)) . '
                                    </div>
                                </div>'
                            );
                        }
                        break;

                    case 'image':
                        if ($item->image) {
                            $imageUrl = Storage::disk('public')->url($item->image);
                            $blockComponent = FlexibleRender::make(
                                '<div style="width: 100%; margin-bottom: 1.5rem;">
                                    <img src="' . e($imageUrl) . '" alt="Изображение" style="width: 100%; height: auto; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                </div>'
                            );
                        }
                        break;

                    case 'video':
                        if ($item->content) {
                            $embedUrl = $this->convertYoutubeUrlToEmbed($item->content);
                            if ($embedUrl) {
                                $blockComponent = FlexibleRender::make(
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
                            }
                        }
                        break;
                }

                if ($blockComponent) {
                    $containerComponents[] = $blockComponent;
                }
            }
        } else {
            $containerComponents[] = Box::make('Обязательное социальное медицинское страхование', [
                Text::make('Информация пока не добавлена')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Обязательное социальное медицинское страхование', $containerComponents),
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
        // Проверяем различные форматы YouTube URL
        // https://www.youtube.com/watch?v=VIDEO_ID
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // https://youtu.be/VIDEO_ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // https://www.youtube.com/embed/VIDEO_ID (уже в правильном формате)
        if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $url;
        }
        
        return null;
    }
}

