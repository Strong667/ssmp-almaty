<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\CorporateDocument;
use App\Models\Document;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\Table\TableBuilder;

#[SkipMenu]
class DocumentsPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Документы';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/documents' => $this->getTitle()
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

        // Отображаем категории с документами
        foreach ($categories as $category) {
            $categoryFields = [
                ID::make()->fillData(['id' => $category->id], 0),
                Text::make('Название категории', 'title')
                    ->fillData(['title' => $category->title], 0)
                    ->readonly(),
            ];

            // Добавляем документы категории
            if ($category->documents->isNotEmpty()) {
                // Используем TableBuilder для отображения документов
                $categoryFields[] = TableBuilder::make(
                    [
                        ID::make(),
                        Text::make('Название документа', 'title'),
                        File::make('Файл', 'file_path')->disk('public'),
                    ],
                    $category->documents
                );
            } else {
                $categoryFields[] = Text::make('Документов в этой категории пока нет')
                    ->readonly();
            }

            $containerComponents[] = Box::make($category->title, $categoryFields);
        }

        if (empty($containerComponents)) {
            $containerComponents[] = Box::make('Документы', [
                Text::make('Документы пока не добавлены')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Документы', $containerComponents),
        ];
    }
}

