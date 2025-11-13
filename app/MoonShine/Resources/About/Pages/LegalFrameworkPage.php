<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\LegalFramework;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\FlexibleRender;

#[SkipMenu]
class LegalFrameworkPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Нормативно-правовая база';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/legal-framework' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $items = LegalFramework::query()
            ->orderBy('created_at')
            ->get();

        $containerComponents = [];

        if ($items->isNotEmpty()) {
            foreach ($items as $item) {
                $fields = [
                    ID::make()->fillData(['id' => $item->id], 0),
                ];

                // Текст
                if ($item->text) {
                    $textContent = nl2br(e($item->text));
                    if ($item->url) {
                        $textContent = '<a href="' . e($item->url) . '" target="_blank" style="color: var(--moonshine-primary, #8b5cf6); text-decoration: none; font-weight: 500; transition: color 0.3s;" onmouseover="this.style.color=\'var(--moonshine-primary-hover, #7c3aed)\'" onmouseout="this.style.color=\'var(--moonshine-primary, #8b5cf6)\'">' . $textContent . ' <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 0.875rem; height: 0.875rem; display: inline-block; vertical-align: middle; margin-left: 0.25rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg></a>';
                    }
                    $fields[] = FlexibleRender::make(
                        '<div style="margin-bottom: 1rem;">
                            <div style="font-size: 1rem; line-height: 1.6; color: var(--moonshine-text, #374151); white-space: pre-wrap;">
                                ' . $textContent . '
                            </div>
                        </div>'
                    );
                }

                // Ссылка отдельно, если есть
                if ($item->url && $item->text) {
                    // Уже включено в текст выше
                } elseif ($item->url) {
                    $fields[] = FlexibleRender::make(
                        '<div style="margin-bottom: 1rem;">
                            <a href="' . e($item->url) . '" target="_blank" style="color: var(--moonshine-primary, #8b5cf6); text-decoration: none; font-weight: 500; transition: color 0.3s;" onmouseover="this.style.color=\'var(--moonshine-primary-hover, #7c3aed)\'" onmouseout="this.style.color=\'var(--moonshine-primary, #8b5cf6)\'">
                                ' . e($item->url) . ' <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 0.875rem; height: 0.875rem; display: inline-block; vertical-align: middle; margin-left: 0.25rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                            </a>
                        </div>'
                    );
                }

                $containerComponents[] = Box::make('', $fields);
            }
        } else {
            $containerComponents[] = Box::make('Нормативно-правовая база', [
                Text::make('Информация пока не добавлена')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Нормативно-правовая база', $containerComponents),
        ];
    }
}

