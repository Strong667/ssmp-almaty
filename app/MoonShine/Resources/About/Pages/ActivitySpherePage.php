<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\CorporateDocument;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Collapse;

#[SkipMenu]
class ActivitySpherePage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Категории документов';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/activity-sphere' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $categories = CorporateDocument::query()
            ->with('documents')
            ->orderBy('title')
            ->get();

        $containerComponents = [];

        if ($categories->isNotEmpty()) {
            foreach ($categories as $index => $category) {
                $documentComponents = [];
                
                if ($category->documents->isNotEmpty()) {
                    // Используем TableBuilder для отображения документов в стиле MoonShine
                    $documentComponents[] = TableBuilder::make(
                        [
                            ID::make(),
                            Text::make('Название документа', 'title'),
                            File::make('Файл', 'file_path')->disk('public'),
                        ],
                        $category->documents
                    );
                } else {
                    $documentComponents[] = Text::make('Документов в этой категории пока нет')
                        ->readonly();
                }
                
                // Используем Collapse для аккордеона в стиле MoonShine
                $containerComponents[] = Collapse::make(
                    $category->title,
                    $documentComponents
                );
            }
        } else {
            $containerComponents[] = Box::make('Категории документов', [
                Text::make('Категории документов пока не добавлены')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Категории документов', $containerComponents),
        ];
    }
}

