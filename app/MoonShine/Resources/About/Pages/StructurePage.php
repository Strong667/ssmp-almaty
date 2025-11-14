<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\Structure;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\CardsBuilder;
use MoonShine\UI\Fields\Text;

#[SkipMenu]
class StructurePage extends Page
{

    public function getTitle(): string
    {
        return 'Структура';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/structure' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $structures = Structure::query()
            ->orderBy('title')
            ->get()
            ->each(function (Structure $structure) {
                $structure->image_url = $structure->image
                    ? Storage::disk('public')->url($structure->image)
                    : null;
            });

        // Подготавливаем данные для CardsBuilder
        $structuresData = $structures->map(function (Structure $structure) {
            return [
                'id' => $structure->id,
                'title' => $structure->title,
                'thumbnail' => $structure->image_url,
            ];
        })->toArray();

        return [
            Box::make('Структура', [
                $structures->isNotEmpty()
                    ? CardsBuilder::make($structuresData, [])
                        ->thumbnail(fn ($data) => $data['thumbnail'] ?? '')
                        ->title(fn ($data) => $data['title'] ?? '')
                        ->subtitle('')
                        ->content('')
                        ->componentAttributes(fn ($data) => [
                            'style' => 'height: 350px; display: flex; flex-direction: column; overflow: hidden;',
                            'class' => 'structure-card'
                        ])
                        ->columnSpan(4)  // 3 карточки в ряд (12/4=3)
                    : Text::make('Структура пока не добавлена')
                        ->readonly(),
            ]),
        ];
    }
}

