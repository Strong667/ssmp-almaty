<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\RubricForPopulation;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Components\FlexibleRender;
use MoonShine\UI\Components\Link;
use Illuminate\Support\Facades\Route;

#[SkipMenu]
class RubricForPopulationPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Рубрика для населения';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/rubric-for-population' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $items = RubricForPopulation::query()
            ->orderBy('created_at', 'desc')
            ->get();

        $containerComponents = [];

        if ($items->isNotEmpty()) {
            $cardsHtml = '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">';
            
            foreach ($items as $item) {
                $imageUrl = $item->image_url ?? '';
                $detailUrl = route('about.rubric-for-population.detail', $item->id);
                $date = $item->created_at ? $item->created_at->format('d-m-Y') : '';
                
                $cardsHtml .= '<div style="border: 1px solid #e5e7eb; border-radius: 0.5rem; overflow: hidden; background: white; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); transition: box-shadow 0.2s;">
                    <div style="width: 100%; height: 200px; overflow: hidden; background: #f3f4f6;">
                        ' . ($imageUrl ? '<img src="' . e($imageUrl) . '" alt="' . e($item->title) . '" style="width: 100%; height: 100%; object-fit: cover;">' : '') . '
                    </div>
                    <div style="padding: 1rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--moonshine-text, #374151);">' . e($item->title) . '</h3>
                        <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">' . e($date) . '</p>
                        <a href="' . e($detailUrl) . '" style="display: inline-block; padding: 0.5rem 1rem; background-color: rgb(139, 92, 246); color: white; text-decoration: none; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; transition: background-color 0.2s;">ПОСМОТРЕТЬ</a>
                    </div>
                </div>';
            }
            
            $cardsHtml .= '</div>';
            
            $containerComponents[] = FlexibleRender::make($cardsHtml);
        } else {
            $containerComponents[] = Box::make('Рубрика для населения', [
                Text::make('Информация пока не добавлена')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Рубрика для населения', $containerComponents),
        ];
    }
}
