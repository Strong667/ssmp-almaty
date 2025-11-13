<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\CardsBuilder;
use MoonShine\UI\Fields\Text;

#[SkipMenu]
class AdministrationPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Администрация';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/administration' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $admins = Admin::query()
            ->orderBy('full_name')
            ->get()
            ->each(function (Admin $admin) {
                $admin->image_url = $admin->image
                    ? Storage::disk('public')->url($admin->image)
                    : null;
            });

        // Подготавливаем данные для CardsBuilder
        $adminsData = $admins->map(function (Admin $admin) {
            return [
                'id' => $admin->id,
                'full_name' => $admin->full_name,
                'position' => $admin->position,
                'email' => $admin->email,
                'thumbnail' => $admin->image_url,
            ];
        })->toArray();

        return [
            Box::make('Администрация', [
                $admins->isNotEmpty()
                    ? CardsBuilder::make($adminsData, [])
                        ->thumbnail(fn ($data) => $data['thumbnail'] ?? '')
                        ->title(fn ($data) => $data['full_name'] ?? '')
                        ->subtitle(fn ($data) => $data['position'] ?? '')
                        ->content(fn ($data) => 
                            '<div style="padding: 1rem;">
                                <div style="font-size: 0.875rem; color: #6c757d; margin-top: 0.5rem;">
                                    <a href="mailto:' . e($data['email'] ?? '') . '" style="color: #1977cc; text-decoration: none;">
                                        ' . e($data['email'] ?? '') . '
                                    </a>
                                </div>
                            </div>'
                        )
                        ->componentAttributes(fn ($data) => [
                            'style' => 'height: 400px; display: flex; flex-direction: column; overflow: hidden;',
                            'class' => 'admin-card'
                        ])
                        ->columnSpan(4)  // 3 карточки в ряд (12/4=3)
                    : Text::make('Администрация пока не добавлена')
                        ->readonly(),
            ]),
        ];
    }
}

