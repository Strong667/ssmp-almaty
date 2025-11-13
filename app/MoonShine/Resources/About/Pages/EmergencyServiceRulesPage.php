<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\EmergencyServiceRules;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\FlexibleRender;

#[SkipMenu]
class EmergencyServiceRulesPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Правила обращения в службу скорой медицинской помощи';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/emergency-service-rules' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $items = EmergencyServiceRules::query()
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
                    $fields[] = FlexibleRender::make(
                        '<div style="margin-bottom: 1rem;">
                            <div style="font-size: 1rem; line-height: 1.6; color: var(--moonshine-text, #374151); white-space: pre-wrap;">
                                ' . nl2br(e($item->text)) . '
                            </div>
                        </div>'
                    );
                }

                $containerComponents[] = Box::make('', $fields);
            }
        } else {
            $containerComponents[] = Box::make('Правила обращения в службу скорой медицинской помощи', [
                Text::make('Информация пока не добавлена')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Правила обращения в службу скорой медицинской помощи', $containerComponents),
        ];
    }
}

