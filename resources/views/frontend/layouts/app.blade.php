<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Медицинский центр')</title>
    <link rel="icon" type="image/png" href="{{ asset('slujba.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('slujba.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('slujba.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        /* Header Styles - Professional Corporate Design */
        #header {
            position: relative;
            background: rgba(60, 60, 65, 0.75);
            background-image: url('{{ asset("72_main.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            z-index: 1030;
        }
        
        @media (min-width: 992px) {
            #header {
                overflow: visible !important;
            }
            
            #header.fixed-top {
                overflow: visible !important;
            }
            
            /* Переопределяем Bootstrap fixed-top overflow */
            .fixed-top {
                overflow: visible !important;
            }
        }

        #header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(60, 60, 65, 0.75);
            z-index: -1;
        }


        /* Первый слой: Социальные сети, контакты, тема, локализация */
        .header-top {
            background: rgba(0, 0, 0, 0.35);
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .header-main-content {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .header-social {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-shrink: 0;
        }

        .header-contacts {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 16px;
            align-items: center;
            flex: 1;
            justify-content: center;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.95);
            font-size: 11px;
            font-weight: 500;
            font-family: "Montserrat", sans-serif;
            line-height: 1.3;
        }

        .contact-item i {
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            flex-shrink: 0;
            text-align: center;
        }

        .contact-item span {
            color: rgba(255, 255, 255, 0.95);
        }

        .contact-item a {
            color: rgba(255, 255, 255, 0.95);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .contact-item a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .social-link {
            color: #fff;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
        }

        .social-link:hover::before {
            width: 100%;
            height: 100%;
        }

        .social-link:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px) scale(1.1);
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .social-link i {
            position: relative;
            z-index: 1;
        }

        .header-top-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
        }

        .mobile-menu-btn {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #fff;
            padding: 0;
            backdrop-filter: blur(10px);
            font-size: 18px;
            position: relative;
            z-index: 10000;
        }

        @media (min-width: 992px) {
            .mobile-menu-btn:hover {
                background: rgba(255, 255, 255, 0.25);
                border-color: rgba(255, 255, 255, 0.4);
                transform: scale(1.1);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            .mobile-menu-btn:active {
                transform: scale(0.95);
            }
        }

        .theme-toggle-btn {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #fff;
            position: relative;
            padding: 0;
            backdrop-filter: blur(10px);
        }

        .theme-toggle-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .theme-toggle-btn:active {
            transform: scale(0.95);
        }

        .theme-toggle-btn i {
            position: absolute;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .theme-icon-light {
            opacity: 1;
            transform: rotate(0deg);
        }

        .theme-icon-dark {
            opacity: 0;
            transform: rotate(90deg);
        }

        [data-theme="dark"] .theme-icon-light {
            opacity: 0;
            transform: rotate(-90deg);
        }

        [data-theme="dark"] .theme-icon-dark {
            opacity: 1;
            transform: rotate(0deg);
        }

        .language-select {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            padding: 6px 12px;
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            min-width: 70px;
        }

        .language-select:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-1px);
        }

        .language-select:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
            outline: none;
        }

        .language-select option {
            background: #2c4964;
            color: #fff;
            padding: 8px;
        }

        /* Второй слой: Логотип с текстом */
        .header-middle {
            background: transparent;
            padding: 30px 0;
            border-bottom: none;
        }

        .logo-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .logo-link:hover {
            transform: translateY(-2px);
        }

        .logo-wrapper {
            position: relative;
            padding: 15px;
            background: transparent;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .logo-link:hover .logo-wrapper {
            background: transparent;
            transform: scale(1.05);
        }

        .logo-img {
            max-height: 220px;
            height: auto;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.3));
            transition: all 0.3s ease;
        }

        .logo-text {
            text-align: left;
        }

        .logo-title {
            font-size: 36px;
            font-weight: 800;
            margin: 0;
            color: #fff;
            line-height: 1.2;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.3), 0 1px 2px rgba(0, 0, 0, 0.2);
            letter-spacing: 0.5px;
            font-family: "Montserrat", sans-serif;
            text-transform: uppercase;
        }

        .logo-subtitle {
            font-size: 20px;
            margin: 8px 0 0 0;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 0.3px;
            font-family: "Montserrat", sans-serif;
        }

        /* Третий слой: Меню навигации */
        .header-bottom {
            background: transparent;
            padding: 4px 0;
            border-top: 2px solid #FFC107;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }
        
        @media (min-width: 992px) {
            .header-bottom {
                overflow: visible !important;
            }
            
            .header-bottom .container-fluid {
                overflow-x: visible !important;
                overflow-y: visible !important;
                padding-bottom: 4px;
            }
        }


        .navbar {
            padding: 0;
        }

        .navbar-collapse {
            flex-grow: 1;
            overflow: hidden;
        }
        
        @media (min-width: 992px) {
            .navbar-collapse {
                overflow: visible !important;
            }
            
            .navbar {
                overflow: visible !important;
            }
            
            .header-bottom .navbar {
                overflow: visible !important;
            }
        }

        .navbar-nav {
            display: flex;
            flex-direction: row;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
            flex-wrap: nowrap;
            gap: 6px;
            width: 100%;
            justify-content: flex-start;
        }
        
        @media (max-width: 991px) {
            .navbar-nav {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scroll-behavior: smooth;
            }
        }

        /* Скрываем скроллбар на мобильных */
        @media (max-width: 991px) {
            .navbar-nav::-webkit-scrollbar {
                display: none;
            }
            
            .navbar-nav {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }

        @media (min-width: 992px) {
            .navbar-nav {
                justify-content: flex-start;
                overflow-x: visible !important;
                overflow-y: visible !important;
                padding-bottom: 4px;
            }
        }

        .nav-item {
            position: relative;
            flex-shrink: 0;
            white-space: nowrap;
        }
        
        @media (min-width: 992px) {
            .nav-item {
                flex-shrink: 0;
            }
            
            .nav-item.dropdown {
                overflow: visible !important;
                position: relative;
            }
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.95);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-weight: 800;
            font-size: 13px;
            font-family: "Montserrat", sans-serif;
            text-transform: uppercase;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            position: relative;
            border-radius: 0;
            flex-shrink: 0;
            background: transparent;
            border: none;
            box-shadow: none;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3), 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .nav-link:hover {
            background: transparent;
            color: rgba(255, 255, 255, 1);
            transform: translateY(0);
            box-shadow: none;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.4), 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .nav-link.active {
            background: transparent;
            color: rgba(255, 255, 255, 1);
            font-weight: 800;
            box-shadow: none;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.4), 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .nav-link i {
            font-size: 14px;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.95);
        }

        .nav-link.active i {
            color: rgba(255, 255, 255, 1);
        }

        .nav-link:hover i {
            color: rgba(255, 255, 255, 1);
        }

        .nav-link i.bi-chevron-down {
            font-size: 12px;
        }

        /* Bootstrap 5 автоматически добавляет стрелку через псевдоэлемент */
        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.25em;
            vertical-align: 0.2em;
            content: "";
            border-top: 0.25em solid rgba(255, 255, 255, 0.95);
            border-right: 0.25em solid transparent;
            border-bottom: 0;
            border-left: 0.25em solid transparent;
            transition: transform 0.3s ease;
        }

        .nav-link.active .dropdown-toggle::after {
            border-top-color: rgba(255, 255, 255, 1);
        }

        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.08);
            padding: 6px 0;
            margin-top: 6px;
            min-width: 240px;
            animation: dropdownFadeIn 0.2s ease;
            left: 50% !important;
            transform: translateX(-50%) !important;
            right: auto !important;
            z-index: 1050 !important;
            position: absolute !important;
            top: 100% !important;
        }
        
        .dropdown-menu.show {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        /* Убеждаемся, что дропдауны видны на десктопе */
        @media (min-width: 992px) {
            .dropdown-menu {
                display: none;
            }
            
            .dropdown-menu.show {
                display: block !important;
            }
            
            .header-bottom .dropdown-menu {
                margin-top: 0;
            }
            
            /* Дропдауны должны выходить за пределы хедера */
            #header {
                overflow: visible !important;
            }
            
            .header-quick-links {
                overflow: visible !important;
            }
            
            /* Увеличиваем z-index дропдаунов, чтобы они были поверх 4-го слоя */
            .header-bottom .dropdown-menu {
                z-index: 1060 !important;
            }
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .dropdown-item {
            padding: 8px 16px;
            color: #2c4964;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            font-size: 13px;
            font-family: "Montserrat", sans-serif;
            font-weight: 600;
            position: relative;
            margin: 1px 6px;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .dropdown-item i {
            display: none;
        }

        .dropdown-item:hover {
            background: rgba(50, 50, 55, 0.95);
            color: #FFC107;
        }

        .dropdown-item.active {
            background: rgba(50, 50, 55, 0.95);
            color: #FFC107;
            font-weight: 700;
        }

        .dropdown-divider {
            margin: 4px 10px;
            opacity: 0.15;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
        }

        .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 12px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            display: none;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* На десктопе меню всегда видно */
        @media (min-width: 992px) {
            .navbar-collapse,
            .navbar-collapse.collapse,
            .navbar-collapse.collapsing {
                display: flex !important;
                flex-basis: auto !important;
                height: auto !important;
                visibility: visible !important;
            }

            .navbar-toggler {
                display: none !important;
            }
        }

        /* Dark Theme */
        [data-theme="dark"] {
            background-color: #1e293b;
            color: #e2e8f0;
        }

        [data-theme="dark"] #header {
            background: rgba(50, 50, 55, 0.75);
            background-image: url('{{ asset("72_main.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        [data-theme="dark"] #header::before {
            background: rgba(50, 50, 55, 0.75);
        }

        [data-theme="dark"] .dropdown-menu {
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.5), 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .dropdown-item {
            color: #e2e8f0;
        }

        [data-theme="dark"] .dropdown-item:hover {
            background: rgba(50, 50, 55, 0.95);
            color: #FFC107;
        }

        [data-theme="dark"] .dropdown-item.active {
            background: rgba(50, 50, 55, 0.95);
            color: #FFC107;
        }

        [data-theme="dark"] .dropdown-item i {
            color: #60a5fa;
        }

        [data-theme="dark"] .dropdown-item:hover i {
            color: #93c5fd;
        }

        [data-theme="dark"] .header-top {
            background: rgba(0, 0, 0, 0.4);
            border-bottom-color: rgba(255, 255, 255, 0.15);
        }

        [data-theme="dark"] .contact-item {
            color: rgba(255, 255, 255, 0.9);
        }

        [data-theme="dark"] .contact-item i {
            color: rgba(255, 255, 255, 0.85);
        }

        [data-theme="dark"] .contact-item span,
        [data-theme="dark"] .contact-item a {
            color: rgba(255, 255, 255, 0.9);
        }

        [data-theme="dark"] .contact-item a:hover {
            color: #fff;
        }

        [data-theme="dark"] .header-bottom::before {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.05) 50%, rgba(255, 255, 255, 0.08) 100%);
            box-shadow:
                0 0 40px rgba(255, 255, 255, 0.08),
                0 0 20px rgba(255, 255, 255, 0.05),
                inset 0 2px 0 rgba(255, 255, 255, 0.15),
                inset 0 -2px 0 rgba(255, 255, 255, 0.1);
        }


        /* В тёмной теме быстрые кнопки остаются как в светлой (белые карточки) */

        /* Средние экраны - если не помещается, центрируем и делаем в несколько рядов */
        @media (max-width: 1200px) and (min-width: 992px) {
            .header-contacts {
                justify-content: flex-start;
            }
        }

        /* Мобильный сайдбар */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 99999;
            display: none;
            pointer-events: none;
        }

        .mobile-sidebar.active {
            display: block;
            pointer-events: auto;
        }

        .mobile-sidebar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-sidebar.active .mobile-sidebar-overlay {
            opacity: 1;
        }

        .mobile-sidebar-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 320px;
            max-width: 85vw;
            height: 100vh;
            background: rgba(44, 73, 100, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.3);
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .mobile-sidebar.active .mobile-sidebar-content {
            transform: translateX(0);
        }

        .mobile-sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .mobile-sidebar-header h3 {
            margin: 0;
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
            text-transform: uppercase;
        }

        .mobile-sidebar-close {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #fff;
            padding: 0;
        }

        .mobile-sidebar-close:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: rotate(90deg);
        }

        .mobile-sidebar-close i {
            font-size: 18px;
        }

        .mobile-sidebar-nav {
            flex: 1;
            padding: 10px 0;
            overflow-y: auto;
        }

        .mobile-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-nav-item {
            margin: 0;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.95);
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            font-family: "Montserrat", sans-serif;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .mobile-nav-link i:first-child {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left-color: #FFC107;
        }

        .mobile-nav-dropdown-toggle {
            position: relative;
        }

        .mobile-dropdown-icon {
            margin-left: auto;
            font-size: 14px;
            transition: transform 0.3s ease;
        }

        .mobile-nav-dropdown-toggle.active .mobile-dropdown-icon {
            transform: rotate(180deg);
        }

        .mobile-nav-dropdown {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: rgba(0, 0, 0, 0.2);
        }

        .mobile-nav-dropdown.active {
            max-height: 1000px;
        }

        .mobile-nav-dropdown-item {
            display: block;
            padding: 10px 20px 10px 56px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            font-family: "Montserrat", sans-serif;
            transition: all 0.3s ease;
        }

        .mobile-nav-dropdown-item:hover,
        .mobile-nav-dropdown-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: #FFC107;
            padding-left: 60px;
        }

        .mobile-nav-divider {
            margin: 15px 0;
        }

        .mobile-nav-divider hr {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin: 0;
        }

        [data-theme="dark"] .mobile-sidebar-content {
            background: rgba(30, 41, 59, 0.98);
        }

        [data-theme="dark"] .mobile-sidebar-header {
            border-bottom-color: rgba(255, 255, 255, 0.15);
        }

        /* Mobile Styles */
        @media (max-width: 991px) {
            /* Показываем кнопку меню на мобильных и фиксируем слева */
            #mobile-menu-toggle {
                display: flex !important;
                position: fixed;
                left: 15px;
                top: 50%;
                transform: translateY(-50%);
                z-index: 100000;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }

            /* Скрываем кнопку меню в header-top-right на мобильных */
            .header-top-right .mobile-menu-btn {
                display: none !important;
            }

            /* Исправляем hover для фиксированной кнопки */
            #mobile-menu-toggle:hover {
                transform: translateY(-50%) scale(1.1);
            }

            #mobile-menu-toggle:active {
                transform: translateY(-50%) scale(0.95);
            }

            /* В первом слое скрываем соцсети и контакты, оставляем только тему и локализацию */
            .header-social {
                display: none;
            }

            .header-contacts {
                display: none;
            }

            .header-main-content {
                display: none;
            }

            /* Центрируем тему и локализацию на мобильных */
            .header-top .row {
                justify-content: center;
            }

            .header-top .col-md-3 {
                text-align: center;
            }

            .header-top-right {
                justify-content: center;
            }

            /* Скрываем третий слой (меню навигации) */
            .header-bottom {
                display: none;
            }

            /* Скрываем четвертый слой (быстрые кнопки) */
            .header-quick-links {
                display: none;
            }

            .logo-link {
                flex-direction: column;
                gap: 12px;
            }

            .logo-text {
                text-align: center;
            }

            .logo-title {
                font-size: 28px;
            }

            .logo-subtitle {
                font-size: 16px;
            }

            .logo-img {
                max-height: 120px;
            }

            .navbar-toggler {
                display: block;
            }

            .navbar-collapse {
                background: rgba(44, 73, 100, 0.98);
                backdrop-filter: blur(20px);
                margin-top: 10px;
                padding: 15px;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            }

            .navbar-collapse:not(.show) {
                display: none !important;
            }

            .navbar-nav {
                flex-direction: column;
                width: 100%;
                justify-content: flex-start;
            }

            .nav-link {
                width: 100%;
                padding: 14px 20px;
                border-radius: 8px;
                margin: 4px 0;
            }

            .dropdown-menu {
                position: static;
                box-shadow: none;
                background: rgba(255, 255, 255, 0.08);
                margin-top: 8px;
                margin-left: 20px;
                border-radius: 8px;
                animation: none;
                left: auto !important;
                transform: none !important;
                right: auto !important;
            }

            .dropdown-item {
                padding: 8px 14px;
                font-size: 12px;
            }

            [data-theme="dark"] .navbar-collapse {
                background: rgba(30, 41, 59, 0.98);
            }
        }

        main {
            padding-top: 0;
        }

        /* Четвертый слой: Быстрые кнопки (только на главной странице) */
        .header-quick-links {
            background: transparent;
            padding: 20px 0;
            border-top: 2px solid #FFC107;
            overflow: visible !important;
            position: relative;
            z-index: 1029;
        }

        .quick-links-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .quick-link-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            background: #FFC107;
            border: none;
            border-radius: 10px;
            color: #212529;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            font-family: "Montserrat", sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .quick-link-btn i {
            font-size: 20px;
            color: #212529;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .quick-link-btn span {
            line-height: 1.3;
            text-align: left;
        }

        .quick-link-btn:hover {
            background: #FFB300;
            color: #000000;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15), 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .quick-link-btn:hover i {
            color: #000000;
            transform: scale(1.1);
        }

        /* Увеличиваем padding-top для main на главной странице (4 слоя) */
        body:has(.header-quick-links) main {
            padding-top: 0;
        }

        @media (max-width: 991px) {
            .quick-links-wrapper {
                gap: 10px;
            }

            .quick-link-btn {
                padding: 10px 15px;
                font-size: 12px;
                flex: 1 1 calc(50% - 5px);
                min-width: 0;
            }

            .quick-link-btn span {
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }

        .section {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            padding-bottom: 40px;
        }

        .section-header h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 20px;
            position: relative;
            color: #2c4964;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            display: block;
            width: 50px;
            height: 3px;
            background: #1977cc;
            bottom: 0;
            left: calc(50% - 25px);
        }

        .section-header p {
            margin-bottom: 0;
            color: #6c757d;
        }

        [data-theme="dark"] .section-header h2 {
            color: #e0e0e0;
        }

        [data-theme="dark"] .section-header p {
            color: #b0b0b0;
        }

        /* Mobile Nav */
        @media (max-width: 991px) {
            .theme-toggle-wrapper {
                margin-left: 0;
                margin-right: 15px;
            }

            #navbar ul {
                display: none;
            }

            .mobile-nav-toggle {
                display: block;
            }

            #navbar {
                position: fixed;
                top: 70px;
                right: -100%;
                width: 300px;
                height: calc(100vh - 70px);
                background: #fff;
                transition: 0.3s;
                box-shadow: -2px 0 15px rgba(0, 0, 0, 0.1);
                z-index: 999;
            }

            #navbar.mobile-nav-active {
                right: 0;
            }

            #navbar ul {
                flex-direction: column;
                padding: 20px 0;
            }

            #navbar li {
                width: 100%;
            }

            #navbar a {
                padding: 15px 30px;
                border-bottom: 1px solid #f0f0f0;
            }

            [data-theme="dark"] #navbar {
                background: linear-gradient(135deg, rgba(30, 41, 59, 0.98) 0%, rgba(15, 23, 42, 0.95) 100%);
                backdrop-filter: blur(25px);
                -webkit-backdrop-filter: blur(25px);
                box-shadow: -4px 0 24px rgba(0, 0, 0, 0.6);
                border-left: 2px solid rgba(25, 119, 204, 0.3);
            }

            [data-theme="dark"] #navbar a {
                color: #e2e8f0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            [data-theme="dark"] #navbar a:hover,
            [data-theme="dark"] #navbar .active {
                color: #60a5fa;
            }
        }

        /* Footer Styles */
        .footer {
            background: rgba(60, 60, 65, 1);
            color: #fff;
            font-size: 16px;
            padding: 60px 0 20px;
        }

        .footer-top {
            padding-bottom: 40px;
        }

        .footer-contact-item {
            margin-bottom: 30px;
        }

        .footer-contact-item h5 {
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: "Montserrat", sans-serif;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            font-weight: 500;
        }

        .contact-info i {
            font-size: 20px;
            color: #1977cc;
            flex-shrink: 0;
        }

        .contact-info a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: color 0.3s;
            font-weight: 500;
        }

        .contact-info a:hover {
            color: #1977cc;
            text-decoration: underline;
        }

        .contact-hours {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .footer-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-nav li {
            padding: 12px 0;
        }

        .footer-nav a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: "Montserrat", sans-serif;
            transition: color 0.3s;
            display: block;
        }

        .footer-nav a:hover {
            color: #1977cc;
        }

        .footer-info-content {
            display: flex;
            flex-direction: column;
        }

        .footer-logo-section {
            margin-top: 0;
            text-align: left;
        }

        .footer-logo-wrapper {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            gap: 25px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .footer-logo {
            flex-shrink: 0;
        }

        .footer-logo img {
            max-height: 140px;
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
            display: block;
        }

        .footer-hospital-name {
            flex: 0 1 auto;
            text-align: left;
        }

        .hospital-name-line {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            line-height: 1.4;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: "Montserrat", sans-serif;
            white-space: nowrap;
        }

        .footer-social {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        .footer-social-link {
            color: #fff;
            font-size: 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .footer-social-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
        }

        .footer-social-link:hover::before {
            width: 100%;
            height: 100%;
        }

        .footer-social-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px) scale(1.1);
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .footer-social-link i {
            position: relative;
            z-index: 1;
        }

        .footer-address {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: "Montserrat", sans-serif;
            margin-top: 0;
        }

        .footer-address strong {
            color: #fff;
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            font-size: 15px;
        }

        .copyright strong {
            color: #fff;
        }

        [data-theme="dark"] .footer {
            background: rgba(50, 50, 55, 1);
            color: #e2e8f0;
        }

        [data-theme="dark"] .footer-contact-item h5,
        [data-theme="dark"] .hospital-name-line,
        [data-theme="dark"] .footer-address strong,
        [data-theme="dark"] .copyright strong {
            color: #fff;
        }

        [data-theme="dark"] .contact-info,
        [data-theme="dark"] .contact-info a,
        [data-theme="dark"] .contact-hours,
        [data-theme="dark"] .footer-nav a,
        [data-theme="dark"] .footer-address,
        [data-theme="dark"] .copyright {
            color: rgba(255, 255, 255, 0.9);
        }

        [data-theme="dark"] .footer-nav a:hover,
        [data-theme="dark"] .contact-info a:hover {
            color: #60a5fa;
        }

        [data-theme="dark"] .contact-info i {
            color: #60a5fa;
        }

        [data-theme="dark"] .copyright {
            border-top-color: rgba(255, 255, 255, 0.1);
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            visibility: hidden;
            opacity: 0;
            right: 30px;
            bottom: 30px;
            z-index: 996;
            background: rgba(60, 60, 65, 1);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: all 0.4s;
            color: #FFC107;
            font-size: 20px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .back-to-top:hover {
            background: rgba(70, 70, 75, 1);
            color: #FFC107;
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        .back-to-top.active {
            visibility: visible;
            opacity: 1;
        }

        [data-theme="dark"] .back-to-top {
            background: rgba(50, 50, 55, 1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .back-to-top:hover {
            background: rgba(60, 60, 65, 1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6);
        }

        @media (max-width: 768px) {
            .back-to-top {
                right: 20px;
                bottom: 20px;
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
        }

        /* Global Styles */
        body {
            font-family: "Poppins", sans-serif;
            color: #2c4964;
        }
        
        @media (min-width: 992px) {
            body {
                overflow-x: hidden;
            }
        }

        a {
            color: #1977cc;
            text-decoration: none;
        }

        a:hover {
            color: #0d5aa7;
            text-decoration: none;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
@include('frontend.components.header')

<main>
    @yield('content')
</main>

@include('frontend.components.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Theme Toggle
    (function() {
        const themeToggle = document.getElementById('theme-toggle');
        if (!themeToggle) return;
        const html = document.documentElement;

        // Получаем сохраненную тему или используем системную
        const savedTheme = localStorage.getItem('theme');
        const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        const currentTheme = savedTheme || systemTheme;

        // Применяем тему при загрузке
        html.setAttribute('data-theme', currentTheme);

        // Переключение темы
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            });
        }

        // Слушаем изменения системной темы
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            if (!localStorage.getItem('theme')) {
                html.setAttribute('data-theme', e.matches ? 'dark' : 'light');
            }
        });
    })();

    // Bootstrap 5 Dropdown работает по клику (стандартное поведение)
    // Bootstrap автоматически обрабатывает клики через data-bs-toggle="dropdown"

        // Back to Top Button
        const backToTop = document.getElementById('back-to-top');
        if (backToTop) {
            // Проверяем начальное положение
            if (window.scrollY > 300) {
                backToTop.classList.add('active');
            }

            // Показываем/скрываем кнопку при скролле
            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    backToTop.classList.add('active');
                } else {
                    backToTop.classList.remove('active');
                }
            });

            // Плавная прокрутка наверх при клике
            backToTop.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

    // Language Switcher
    (function() {
        const languageSelect = document.getElementById('language-select');
        if (!languageSelect) return;

        languageSelect.addEventListener('change', function() {
            const locale = this.value;
            const url = '{{ route("locale.switch", ["locale" => ":locale"]) }}'.replace(':locale', locale);
            window.location.href = url;
        });
    })();

    // Mobile Sidebar
    (function() {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileSidebarClose = document.getElementById('mobile-sidebar-close');
        const mobileSidebarOverlay = mobileSidebar?.querySelector('.mobile-sidebar-overlay');
        const body = document.body;

        function openSidebar() {
            if (mobileSidebar) {
                mobileSidebar.classList.add('active');
                body.style.overflow = 'hidden';
            }
        }

        function closeSidebar() {
            if (mobileSidebar) {
                mobileSidebar.classList.remove('active');
                body.style.overflow = '';
            }
        }

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                openSidebar();
            });
        }

        if (mobileSidebarClose) {
            mobileSidebarClose.addEventListener('click', function(e) {
                e.preventDefault();
                closeSidebar();
            });
        }

        if (mobileSidebarOverlay) {
            mobileSidebarOverlay.addEventListener('click', function() {
                closeSidebar();
            });
        }

        // Обработка выпадающих меню в сайдбаре
        const dropdownToggles = document.querySelectorAll('.mobile-nav-dropdown-toggle');
        dropdownToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const dropdown = document.getElementById(targetId);
                
                if (dropdown) {
                    const isActive = dropdown.classList.contains('active');
                    
                    // Закрываем все остальные выпадающие меню
                    document.querySelectorAll('.mobile-nav-dropdown').forEach(function(dd) {
                        dd.classList.remove('active');
                    });
                    document.querySelectorAll('.mobile-nav-dropdown-toggle').forEach(function(tt) {
                        tt.classList.remove('active');
                    });
                    
                    // Открываем/закрываем текущее меню
                    if (!isActive) {
                        dropdown.classList.add('active');
                        this.classList.add('active');
                    }
                }
            });
        });
    })();
</script>

</body>
@stack('scripts')
<script src="{{ asset('js/saqtandyry-plugin.js') }}"></script>
</html>

<script src="{{ asset('js/saqtandyry-plugin.js') }}"></script>
</html>
