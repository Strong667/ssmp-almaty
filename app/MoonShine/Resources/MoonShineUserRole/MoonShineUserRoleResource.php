<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\MoonShineUserRole;

use MoonShine\Support\Enums\Action;
use Illuminate\Contracts\Validation\Rule;
use MoonShine\Laravel\Models\MoonshineUserRole;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\MenuManager\Attributes\Group;
use MoonShine\MenuManager\Attributes\Order;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\ListOf;
use App\MoonShine\Pages\MoonShineUserRole\MoonShineUserRoleIndexPage;
use App\MoonShine\Pages\MoonShineUserRole\MoonShineUserRoleFormPage;
use MoonShine\Crud\Contracts\Page\DetailPageContract;

#[Icon('bookmark')]
#[Group('moonshine::ui.resource.system', 'users', translatable: true)]
#[Order(1)]
/**
 * @extends ModelResource<MoonshineUserRole>
 */
class MoonShineUserRoleResource extends ModelResource
{
    protected string $model = MoonshineUserRole::class;

    protected string $column = 'name';

    protected bool $createInModal = true;

    protected bool $detailInModal = true;

    protected bool $editInModal = true;

    protected bool $cursorPaginate = true;

    /**
     * @return list<class-string<\MoonShine\Contracts\Core\PageContract>>
     */
    protected function pages(): array
    {
        return [
            MoonShineUserRoleIndexPage::class,
            MoonShineUserRoleFormPage::class,
            DetailPageContract::class,
        ];
    }

    public function getTitle(): string
    {
        return __('moonshine::ui.resource.role');
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()->except(Action::VIEW);
    }

    /**
     * @return array<string, string[]|string|list<Rule>|list<Stringable>>
     */
    protected function rules($item): array
    {
        return [
            'name' => ['required', 'min:5'],
        ];
    }

    protected function search(): array
    {
        return [
            'id',
            'name',
        ];
    }
}
