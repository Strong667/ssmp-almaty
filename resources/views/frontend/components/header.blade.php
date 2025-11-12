<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('slujba.png') }}" alt="Логотип" class="img-fluid" style="max-height: 60px;">
            </a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto{{ request()->routeIs('home') ? ' active' : '' }}" href="{{ route('home') }}">Главная</a></li>
                <li class="dropdown">
                    <a class="nav-link{{ request()->routeIs('about.*') ? ' active' : '' }}" href="#">
                        О нас <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link{{ request()->routeIs('about.administration') ? ' active' : '' }}" href="{{ route('about.administration') }}">Администрация</a></li>
                        <li><a class="nav-link{{ request()->routeIs('about.schedule') ? ' active' : '' }}" href="{{ route('about.schedule') }}">График приёма граждан</a></li>
                        <li><a class="nav-link{{ request()->routeIs('about.structure') ? ' active' : '' }}" href="{{ route('about.structure') }}">Структура</a></li>
                        <li><a class="nav-link{{ request()->routeIs('about.mission') ? ' active' : '' }}" href="{{ route('about.mission') }}">Миссия и ценности</a></li>
                        <li><a class="nav-link{{ request()->routeIs('about.ethical-code') ? ' active' : '' }}" href="{{ route('about.ethical-code') }}">Этический кодекс</a></li>
                        <li><a class="nav-link{{ request()->routeIs('about.income-expense') ? ' active' : '' }}" href="{{ route('about.income-expense') }}">Отчёты о доходах и расходах</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="#services">Услуги</a></li>
                <li><a class="nav-link scrollto" href="#news">Новости</a></li>
                <li><a class="nav-link scrollto" href="#contact">Контакты</a></li>
            </ul>
            <div class="theme-toggle-wrapper">
                <button id="theme-toggle" class="theme-toggle" aria-label="Переключить тему">
                    <i class="bi bi-sun-fill theme-icon-light"></i>
                    <i class="bi bi-moon-fill theme-icon-dark"></i>
                </button>
            </div>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>
