<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\StateFlag;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Components\FlexibleRender;

#[SkipMenu]
class StateFlagPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Государственный Флаг';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/state-symbols/flag' => $this->getTitle()
        ];
    }

    protected function components(): iterable
    {
        $item = StateFlag::query()->first();

        $containerComponents = [];

        if ($item) {
            // Изображение
            if ($item->image) {
                $imageUrl = $item->image_url;
                $containerComponents[] = FlexibleRender::make(
                    '<div style="width: 100%; margin-bottom: 1.5rem; text-align: center;">
                        <img src="' . e($imageUrl) . '" alt="Государственный Флаг" style="max-width: 100%; height: auto; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
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
        } else {
            $containerComponents[] = Box::make('Государственный Флаг', [
                Text::make('Информация пока не добавлена')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Государственный Флаг', $containerComponents),
        ];
    }
}

