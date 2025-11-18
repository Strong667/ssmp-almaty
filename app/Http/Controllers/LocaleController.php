<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale)
    {
        // Проверяем, что локаль поддерживается
        if (!in_array($locale, ['ru', 'kk'])) {
            $locale = 'ru';
        }

        // Устанавливаем локаль
        App::setLocale($locale);
        Session::put('locale', $locale);

        // Возвращаемся на предыдущую страницу или на главную
        return redirect()->back();
    }
}

