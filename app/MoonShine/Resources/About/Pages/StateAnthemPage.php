<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\StateAnthem;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Components\FlexibleRender;

#[SkipMenu]
class StateAnthemPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Государственный Гимн';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/state-symbols/anthem' => $this->getTitle()
        ];
    }

    protected function components(): iterable
    {
        $item = StateAnthem::query()->first();

        $containerComponents = [];

        if ($item) {
            // Изображение
            if ($item->image) {
                $imageUrl = $item->image_url;
                $containerComponents[] = FlexibleRender::make(
                    '<div style="width: 100%; margin-bottom: 1.5rem; text-align: center;">
                        <img src="' . e($imageUrl) . '" alt="Государственный Гимн" style="max-width: 100%; height: auto; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    </div>'
                );
            }

            // Описание
            $containerComponents[] = Box::make('', [
                ID::make()->fillData(['id' => $item->id], 0),
                Textarea::make('Описание', 'description')
                    ->fillData(['description' => $item->description], 0)
                    ->readonly()
                    ->customAttributes(['rows' => 5]),
            ]);

            // Аудио плеер
            if ($item->audio_file) {
                $audioUrl = $item->audio_url;
                $audioExtension = strtolower(pathinfo($item->audio_file, PATHINFO_EXTENSION));
                $audioType = match($audioExtension) {
                    'mp3' => 'audio/mpeg',
                    'wav' => 'audio/wav',
                    'ogg' => 'audio/ogg',
                    'm4a' => 'audio/mp4',
                    default => 'audio/mpeg',
                };
                $containerComponents[] = FlexibleRender::make(
                    '<div style="width: 100%; margin-bottom: 1.5rem;">
                        <audio controls style="width: 100%; border-radius: 0.375rem;">
                            <source src="' . e($audioUrl) . '" type="' . e($audioType) . '">
                            Ваш браузер не поддерживает аудио элемент.
                        </audio>
                    </div>'
                );
            }

            // Текст гимна
            if ($item->text) {
                $containerComponents[] = Box::make('', [
                    Textarea::make('Текст гимна', 'text')
                        ->fillData(['text' => $item->text], 0)
                        ->readonly()
                        ->customAttributes(['rows' => 10]),
                ]);
            }
        } else {
            $containerComponents[] = Box::make('Государственный Гимн', [
                Text::make('Информация пока не добавлена')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Государственный Гимн', $containerComponents),
        ];
    }
}

