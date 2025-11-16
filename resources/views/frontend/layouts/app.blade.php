<!DOCTYPE html>
<html lang="ru">
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
            background: linear-gradient(135deg, rgba(44, 73, 100, 0.7) 0%, rgba(25, 119, 204, 0.7) 100%);
            background-image: url('{{ asset("72_main.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        #header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(44, 73, 100, 0.7) 0%, rgba(25, 119, 204, 0.7) 100%);
            z-index: -1;
        }


        /* Первый слой: Социальные сети, контакты, тема, локализация */
        .header-top {
            background: rgba(0, 0, 0, 0.2);
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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .logo-link:hover .logo-wrapper {
            background: rgba(255, 255, 255, 0.15);
            transform: scale(1.05);
        }

        .logo-img {
            max-height: 160px;
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
            padding: 15px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }


        .navbar {
            padding: 0;
        }

        .navbar-collapse {
            flex-grow: 1;
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
            justify-content: center;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .navbar-nav::-webkit-scrollbar {
            display: none;
        }

        .navbar-nav {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @media (min-width: 992px) {
            .navbar-nav {
                justify-content: center;
                overflow-x: visible;
            }
        }

        .nav-item {
            position: relative;
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
            background: #f0fdfa;
            color: #0d9488;
        }

        .dropdown-item.active {
            background: #f0fdfa;
            color: #0d9488;
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
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.7) 0%, rgba(15, 23, 42, 0.7) 100%);
            background-image: url('{{ asset("72_main.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        [data-theme="dark"] #header::before {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.7) 0%, rgba(15, 23, 42, 0.7) 100%);
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
            background: rgba(13, 148, 136, 0.15);
            color: #5eead4;
        }

        [data-theme="dark"] .dropdown-item.active {
            background: rgba(13, 148, 136, 0.2);
            color: #5eead4;
        }

        [data-theme="dark"] .dropdown-item i {
            color: #60a5fa;
        }

        [data-theme="dark"] .dropdown-item:hover i {
            color: #93c5fd;
        }

        [data-theme="dark"] .header-top {
            background: rgba(0, 0, 0, 0.3);
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

        /* Mobile Styles */
        @media (max-width: 991px) {
            .header-main-content {
                flex-direction: column;
                gap: 12px;
                align-items: center;
                width: 100%;
            }

            .header-social {
                justify-content: center;
            }

            .header-contacts {
                flex-direction: column;
                gap: 8px;
                align-items: center;
                width: 100%;
                justify-content: center;
            }

            .contact-item {
                font-size: 10px;
                flex-direction: column;
                text-align: center;
                gap: 4px;
            }

            .contact-item i {
                font-size: 14px;
            }

            .contact-item span,
            .contact-item a {
                text-align: center;
            }

            .social-link {
                width: 28px;
                height: 28px;
                font-size: 14px;
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
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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
            background: #ffffff;
            border: none;
            border-radius: 10px;
            color: #0d9488;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            font-family: "Montserrat", sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .quick-link-btn i {
            font-size: 20px;
            color: #0d9488;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .quick-link-btn span {
            line-height: 1.3;
            text-align: left;
        }

        .quick-link-btn:hover {
            background: #f0fdfa;
            color: #0f766e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15), 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .quick-link-btn:hover i {
            color: #0f766e;
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
            background: #2c4964;
            color: #fff;
            font-size: 14px;
            padding: 60px 0 20px;
        }

        .footer-top {
            padding-bottom: 40px;
        }

        .footer h4 {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .footer h4::after {
            content: '';
            position: absolute;
            display: block;
            width: 50px;
            height: 2px;
            background: #1977cc;
            bottom: 0;
            left: 0;
        }

        .footer .footer-info p {
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
        }

        .footer .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer .footer-links ul li {
            padding: 8px 0;
        }

        .footer .footer-links ul a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: 0.3s;
        }

        .footer .footer-links ul a:hover {
            color: #1977cc;
            padding-left: 5px;
        }

        .footer .footer-contact p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
        }

        .footer .footer-contact strong {
            color: #fff;
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
        }

        .copyright strong {
            color: #fff;
        }

        [data-theme="dark"] .footer {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }

        [data-theme="dark"] .footer h4 {
            color: #fff;
        }

        [data-theme="dark"] .footer .footer-links ul a {
            color: rgba(255, 255, 255, 0.7);
        }

        [data-theme="dark"] .footer .footer-links ul a:hover {
            color: #1977cc;
        }

        [data-theme="dark"] .footer .footer-contact p,
        [data-theme="dark"] .footer .footer-info p {
            color: rgba(255, 255, 255, 0.7);
        }

        [data-theme="dark"] .copyright {
            color: rgba(255, 255, 255, 0.7);
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            visibility: hidden;
            opacity: 0;
            right: 30px;
            bottom: 30px;
            z-index: 996;
            background: #1977cc;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: all 0.4s;
            color: #fff;
            font-size: 20px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(25, 119, 204, 0.3);
        }

        .back-to-top:hover {
            background: #0d5aa7;
            color: #fff;
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(25, 119, 204, 0.4);
        }

        .back-to-top.active {
            visibility: visible;
            opacity: 1;
        }

        [data-theme="dark"] .back-to-top {
            background: #1977cc;
            box-shadow: 0 4px 12px rgba(25, 119, 204, 0.5);
        }

        [data-theme="dark"] .back-to-top:hover {
            background: #0d5aa7;
            box-shadow: 0 6px 20px rgba(25, 119, 204, 0.6);
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

    // Bootstrap 5 Dropdown с задержкой закрытия при наведении
    document.addEventListener('DOMContentLoaded', function() {
        // Добавляем задержку закрытия дропдаунов при наведении
        const dropdowns = document.querySelectorAll('.dropdown');
        let hoverTimeouts = {};

        dropdowns.forEach(function(dropdown) {
            const toggle = dropdown.querySelector('.dropdown-toggle');
            const menu = dropdown.querySelector('.dropdown-menu');
            
            if (!toggle || !menu) return;

            const dropdownId = dropdown.getAttribute('data-dropdown-id') || Math.random().toString(36);
            dropdown.setAttribute('data-dropdown-id', dropdownId);

            // При наведении на dropdown
            dropdown.addEventListener('mouseenter', function() {
                // Очищаем таймер закрытия, если он есть
                if (hoverTimeouts[dropdownId]) {
                    clearTimeout(hoverTimeouts[dropdownId]);
                    hoverTimeouts[dropdownId] = null;
                }
                // Открываем дропдаун
                const bsDropdown = bootstrap.Dropdown.getOrCreateInstance(toggle);
                bsDropdown.show();
            });

            // При уходе курсора с dropdown
            dropdown.addEventListener('mouseleave', function() {
                hoverTimeouts[dropdownId] = setTimeout(function() {
                    const bsDropdown = bootstrap.Dropdown.getInstance(toggle);
                    if (bsDropdown) {
                        bsDropdown.hide();
                    }
                    hoverTimeouts[dropdownId] = null;
                }, 200); // Задержка 200ms перед закрытием
            });
        });

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
    });
</script>
@stack('scripts')
</body>
</html>
