<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\EthicalCode;

use App\Models\EthicalCode;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Resources\EthicalCode\Pages\EthicalCodeIndexPage;
use App\MoonShine\Resources\EthicalCode\Pages\EthicalCodeFormPage;
use App\MoonShine\Resources\EthicalCode\Pages\EthicalCodeDetailPage;

class EthicalCodeResource extends ModelResource
{
    protected string $model = EthicalCode::class;

    protected string $title = 'Этический кодекс';

    /**
     * @return list<class-string<\MoonShine\Contracts\Core\PageContract>>
     */
    protected function pages(): array
    {
        return [
            EthicalCodeIndexPage::class,
            EthicalCodeFormPage::class,
            EthicalCodeDetailPage::class,
        ];
    }
}
