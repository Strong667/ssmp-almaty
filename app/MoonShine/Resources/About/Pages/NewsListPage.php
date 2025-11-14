<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\News;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\FlexibleRender;

#[SkipMenu]
class NewsListPage extends Page
{

    public function getTitle(): string
    {
        return 'Новости';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/news' => $this->getTitle()
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
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        $containerComponents = [];

        if ($news->isNotEmpty()) {
            // Создаём HTML таблицу в стиле MoonShine
            $tableRows = '';
            $isEven = false;
            foreach ($news as $item) {
                $bgColor = $isEven ? 'var(--moonshine-bg-secondary, #f9fafb)' : 'var(--moonshine-bg, #fff)';
                $slug = $item->slug ?? null;
                $newsDetailUrl = $slug ? route('news.detail', $slug) : '#';
                $tableRows .= '<tr style="background-color: ' . $bgColor . '; border-bottom: 1px solid var(--moonshine-border, #e5e7eb); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor=\'var(--moonshine-bg-hover, #f3f4f6)\'" onmouseout="this.style.backgroundColor=\'' . $bgColor . '\'">
                    <td style="padding: 0.75rem 1rem; color: var(--moonshine-text-secondary, #6b7280); font-size: 0.875rem;">' . $item->id . '</td>
                    <td style="padding: 0.75rem 1rem;"><a href="' . e($newsDetailUrl) . '" style="color: var(--moonshine-primary, #8b5cf6); text-decoration: none; font-weight: 500; transition: color 0.3s; font-size: 0.875rem;" onmouseover="this.style.color=\'var(--moonshine-primary-hover, #7c3aed)\'" onmouseout="this.style.color=\'var(--moonshine-primary, #8b5cf6)\'">' . e($item->title) . '</a></td>
                    <td style="padding: 0.75rem 1rem; color: var(--moonshine-text-secondary, #6b7280); font-size: 0.875rem;">' . e($item->display_date) . '</td>
                </tr>';
                $isEven = !$isEven;
            }
            
            $containerComponents[] = FlexibleRender::make(
                '<div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; background-color: var(--moonshine-bg, #fff); border-radius: 0.5rem; overflow: hidden;">
                        <thead>
                            <tr style="background-color: var(--moonshine-bg-secondary, #f9fafb); border-bottom: 1px solid var(--moonshine-border, #e5e7eb);">
                                <th style="padding: 0.75rem 1rem; text-align: left; font-weight: 600; color: var(--moonshine-text, #374151); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">ID</th>
                                <th style="padding: 0.75rem 1rem; text-align: left; font-weight: 600; color: var(--moonshine-text, #374151); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">Название</th>
                                <th style="padding: 0.75rem 1rem; text-align: left; font-weight: 600; color: var(--moonshine-text, #374151); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">Дата добавления</th>
                            </tr>
                        </thead>
                        <tbody>
                            ' . $tableRows . '
                        </tbody>
                    </table>
                </div>'
            );
        } else {
            $containerComponents[] = Box::make('Новости', [
                Text::make('Новостей пока нет')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Новости', $containerComponents),
        ];
    }
}

