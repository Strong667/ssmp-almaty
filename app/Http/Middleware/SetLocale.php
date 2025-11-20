<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Получаем локаль из сессии или используем дефолтную
        // Если сессия еще не инициализирована, используем дефолтную локаль
        $locale = Session::has('locale') ? Session::get('locale') : config('app.locale');
        
        // Устанавливаем локаль
        App::setLocale($locale);
        
        // Сохраняем локаль в сессии для следующего запроса
        if (!Session::has('locale')) {
            Session::put('locale', $locale);
        }

        return $next($request);
    }
}

