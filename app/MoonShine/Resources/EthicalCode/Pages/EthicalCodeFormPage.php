<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\EthicalCode\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\File;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\EthicalCode\EthicalCodeResource;
use MoonShine\Support\ListOf;
use Throwable;

/**
 * @extends FormPage<EthicalCodeResource>
 */
class EthicalCodeFormPage extends FormPage
{
    /**
     * Поля формы добавления/редактирования
     *
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),

            Text::make('Название', 'title')
                ->required()
                ->placeholder('Введите название документа'),

            File::make('PDF файл', 'pdf_path')
                ->allowedExtensions(['pdf'])
                ->disk('public')
                ->dir('ethical_codes')
                ->removable()
                ->hint('Загрузите файл в формате PDF'),
        ];
    }

    /**
     * Валидация
     */
    protected function rules(DataWrapperContract $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'pdf_path' => ['nullable', 'file', 'mimes:pdf'],
        ];
    }
}
