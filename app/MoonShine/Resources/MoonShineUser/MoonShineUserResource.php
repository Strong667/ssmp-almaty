<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\MoonShineUser;

use MoonShine\Support\Enums\Action;
use Illuminate\Validation\Rule;
use MoonShine\Laravel\Models\MoonshineUser;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\MenuManager\Attributes\Group;
use MoonShine\MenuManager\Attributes\Order;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\ListOf;
use App\MoonShine\Pages\MoonShineUser\MoonShineUserIndexPage;
use App\MoonShine\Pages\MoonShineUser\MoonShineUserFormPage;
use MoonShine\Crud\Contracts\Page\DetailPageContract;

#[Icon('users')]
#[Group('moonshine::ui.resource.system', 'users', translatable: true)]
#[Order(1)]
/**
 * @extends ModelResource<MoonshineUser>
 */
class MoonShineUserResource extends ModelResource
{
    protected string $model = MoonshineUser::class;

    protected string $column = 'name';

    protected array $with = ['moonshineUserRole'];

    protected bool $simplePaginate = true;

    protected bool $columnSelection = true;

    /**
     * @return list<class-string<\MoonShine\Contracts\Core\PageContract>>
     */
    protected function pages(): array
    {
        return [
            MoonShineUserIndexPage::class,
            MoonShineUserFormPage::class,
            DetailPageContract::class,
        ];
    }

    public function getTitle(): string
    {
        return __('moonshine::ui.resource.admins_title');
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
            'name' => 'required',
            'moonshine_user_role_id' => 'required',
            'email' => [
                'sometimes',
                'bail',
                'required',
                'email',
                Rule::unique('moonshine_users')->ignoreModel($item),
            ],
            'avatar' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,gif'],
            'password' => $item->exists
                ? 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat'
                : 'required|min:6|required_with:password_repeat|same:password_repeat',
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
