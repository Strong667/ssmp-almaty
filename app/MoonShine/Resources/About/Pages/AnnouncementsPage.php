<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\AnnouncementCategory;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Collapse;

#[SkipMenu]
class AnnouncementsPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Объявления';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/announcements' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $categories = AnnouncementCategory::query()
            ->with('announcements')
            ->orderBy('title')
            ->get();

        $containerComponents = [];

        if ($categories->isNotEmpty()) {
            foreach ($categories as $category) {
                $announcementComponents = [];

                if ($category->announcements->isNotEmpty()) {
                    // Используем TableBuilder для отображения объявлений в стиле MoonShine
                    $announcementComponents[] = TableBuilder::make(
                        [
                            ID::make(),
                            Textarea::make('Текст объявления', 'text'),
                            File::make('Файл', 'file_path')->disk('public'),
                        ],
                        $category->announcements
                    );
                } else {
                    $announcementComponents[] = Text::make('Объявлений в этой категории пока нет')
                        ->readonly();
                }

                // Используем Collapse для аккордеона в стиле MoonShine
                $containerComponents[] = Collapse::make(
                    $category->title,
                    $announcementComponents
                );
            }
        } else {
            $containerComponents[] = Box::make('Объявления', [
                Text::make('Категории объявлений пока не добавлены')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Объявления', $containerComponents),
        ];
    }
}

