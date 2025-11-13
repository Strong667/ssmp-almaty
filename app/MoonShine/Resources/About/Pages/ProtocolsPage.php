<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\Protocol;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Collapse;

#[SkipMenu]
class ProtocolsPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Протоколы';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/protocols' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        // Группируем протоколы по годам
        $protocolsByYear = Protocol::query()
            ->orderByDesc('year')
            ->orderBy('title')
            ->get()
            ->groupBy('year');

        $containerComponents = [];

        if ($protocolsByYear->isNotEmpty()) {
            foreach ($protocolsByYear as $year => $protocols) {
                $protocolComponents = [];
                
                // Используем TableBuilder для отображения протоколов в стиле MoonShine
                $protocolComponents[] = TableBuilder::make(
                    [
                        ID::make(),
                        Text::make('Название', 'title'),
                        File::make('Файл', 'file_path')->disk('public'),
                    ],
                    $protocols
                );
                
                // Используем Collapse для аккордеона по годам в стиле MoonShine
                $containerComponents[] = Collapse::make(
                    'Протоколы за ' . $year . ' год',
                    $protocolComponents
                );
            }
        } else {
            $containerComponents[] = Box::make('Протоколы', [
                Text::make('Протоколы пока не добавлены')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Протоколы', $containerComponents),
        ];
    }
}

