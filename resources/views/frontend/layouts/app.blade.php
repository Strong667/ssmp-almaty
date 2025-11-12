<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Медицинский центр')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        /* Header Styles */
        #header {
            background: linear-gradient(135deg, rgba(44, 73, 100, 0.95) 0%, rgba(25, 119, 204, 0.9) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 997;
            padding: 18px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid rgba(255, 255, 255, 0.15);
        }

        #header.fixed-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        #header.header-scrolled {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.95) 100%);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            border-bottom: 2px solid rgba(25, 119, 204, 0.2);
            padding: 12px 0;
        }

        #header .logo img {
            max-height: 60px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        #navbar {
            padding: 0;
        }

        #navbar ul {
            margin: 0;
            padding: 0;
            display: flex;
            list-style: none;
            align-items: center;
        }

        #navbar li {
            position: relative;
        }

        #navbar .dropdown {
            position: relative;
        }

        #navbar .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 220px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            padding: 10px 0;
            margin-top: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            list-style: none;
            display: flex;
            flex-direction: column;
        }

        #navbar .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        #navbar .dropdown-menu li {
            width: 100%;
            display: block;
        }

        #navbar .dropdown-menu .nav-link {
            padding: 12px 25px;
            color: #2c4964;
            text-shadow: none;
            display: block;
            width: 100%;
        }

        #navbar .dropdown-menu .nav-link:hover {
            background: rgba(25, 119, 204, 0.1);
            color: #1977cc;
        }

        #navbar .dropdown-menu .nav-link.active {
            background: rgba(25, 119, 204, 0.15);
            color: #1977cc;
            font-weight: 600;
        }

        #navbar .dropdown > .nav-link i {
            font-size: 12px;
            margin-left: 5px;
            transition: transform 0.3s;
        }

        #navbar .dropdown:hover > .nav-link i {
            transform: rotate(180deg);
        }

        #navbar a,
        #navbar a:focus {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0 10px 30px;
            font-size: 15px;
            font-weight: 600;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            white-space: nowrap;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        #navbar a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 30px;
            right: 30px;
            height: 3px;
            background: rgba(255, 255, 255, 0.8);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 2px;
        }

        #navbar a:hover::after,
        #navbar .active::after {
            transform: scaleX(1);
        }

        #header.header-scrolled #navbar a,
        #header.header-scrolled #navbar a:focus {
            color: #2c4964;
            text-shadow: none;
        }

        #header.header-scrolled #navbar a::after {
            background: linear-gradient(90deg, #1977cc 0%, #667eea 100%);
        }

        #navbar a:hover,
        #navbar .active,
        #navbar .active:focus {
            color: #ffffff;
            transform: translateY(-2px);
        }

        #header.header-scrolled #navbar a:hover,
        #header.header-scrolled #navbar .active,
        #header.header-scrolled #navbar .active:focus {
            color: #1977cc;
            transform: translateY(-2px);
        }

        #navbar a i,
        #navbar a:focus i {
            font-size: 12px;
            line-height: 0;
            margin-left: 5px;
        }

        .mobile-nav-toggle {
            color: #ffffff;
            font-size: 28px;
            cursor: pointer;
            display: none;
            line-height: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.4));
            padding: 8px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
        }

        .mobile-nav-toggle:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.1);
        }

        #header.header-scrolled .mobile-nav-toggle {
            color: #2c4964;
            filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
            background: rgba(25, 119, 204, 0.1);
        }

        #header.header-scrolled .mobile-nav-toggle:hover {
            background: rgba(25, 119, 204, 0.2);
            color: #1977cc;
        }

        .theme-toggle {
            background: rgba(255, 255, 255, 0.25);
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.35);
            border-color: rgba(255, 255, 255, 0.9);
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        #header.header-scrolled .theme-toggle {
            background: linear-gradient(135deg, rgba(25, 119, 204, 0.1) 0%, rgba(102, 126, 234, 0.1) 100%);
            border: 2px solid rgba(25, 119, 204, 0.4);
            color: #1977cc;
            box-shadow: 0 2px 8px rgba(25, 119, 204, 0.2);
        }

        #header.header-scrolled .theme-toggle:hover {
            background: linear-gradient(135deg, #1977cc 0%, #667eea 100%);
            border-color: #1977cc;
            color: #ffffff;
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 6px 20px rgba(25, 119, 204, 0.4);
        }

        .theme-toggle-wrapper {
            margin-left: 20px;
            display: flex;
            align-items: center;
        }

        .theme-toggle i {
            position: absolute;
            font-size: 18px;
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

        [data-theme="dark"] .theme-toggle {
            border-color: #fff;
            color: #fff;
        }

        [data-theme="dark"] .theme-toggle:hover {
            background: #fff;
            color: #2c4964;
        }

        [data-theme="dark"] {
            background-color: #1e293b;
            color: #e2e8f0;
        }

        [data-theme="dark"] #navbar .dropdown-menu {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.98) 0%, rgba(15, 23, 42, 0.95) 100%);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(25, 119, 204, 0.3);
        }

        [data-theme="dark"] #navbar .dropdown-menu .nav-link {
            color: #e2e8f0;
        }

        [data-theme="dark"] #navbar .dropdown-menu .nav-link:hover {
            background: rgba(25, 119, 204, 0.2);
            color: #1977cc;
        }

        [data-theme="dark"] #navbar .dropdown-menu .nav-link.active {
            background: rgba(25, 119, 204, 0.3);
            color: #1977cc;
            font-weight: 600;
        }

        [data-theme="dark"] #header {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.95) 0%, rgba(15, 23, 42, 0.9) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 2px solid rgba(25, 119, 204, 0.3);
        }

        [data-theme="dark"] #header.header-scrolled {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.98) 0%, rgba(15, 23, 42, 0.95) 100%);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            border-bottom: 2px solid rgba(25, 119, 204, 0.4);
        }

        [data-theme="dark"] #navbar a,
        [data-theme="dark"] #navbar a:focus {
            color: #e2e8f0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] #navbar a::after {
            background: rgba(25, 119, 204, 0.8);
        }

        [data-theme="dark"] #header.header-scrolled #navbar a,
        [data-theme="dark"] #header.header-scrolled #navbar a:focus {
            color: #e2e8f0;
            text-shadow: none;
        }

        [data-theme="dark"] #header.header-scrolled #navbar a::after {
            background: linear-gradient(90deg, #1977cc 0%, #60a5fa 100%);
        }

        [data-theme="dark"] #navbar a:hover,
        [data-theme="dark"] #navbar .active {
            color: #ffffff;
            transform: translateY(-2px);
        }

        [data-theme="dark"] #header.header-scrolled #navbar a:hover,
        [data-theme="dark"] #header.header-scrolled #navbar .active {
            color: #60a5fa;
            transform: translateY(-2px);
        }

        [data-theme="dark"] .mobile-nav-toggle {
            color: #e2e8f0;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.5));
            background: rgba(25, 119, 204, 0.2);
        }

        [data-theme="dark"] .mobile-nav-toggle:hover {
            background: rgba(25, 119, 204, 0.35);
            color: #ffffff;
        }

        [data-theme="dark"] #header.header-scrolled .mobile-nav-toggle {
            color: #e2e8f0;
            filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.3));
            background: rgba(25, 119, 204, 0.15);
        }

        [data-theme="dark"] #header.header-scrolled .mobile-nav-toggle:hover {
            background: rgba(25, 119, 204, 0.3);
            color: #60a5fa;
        }

        [data-theme="dark"] .theme-toggle {
            background: rgba(25, 119, 204, 0.25);
            border-color: rgba(25, 119, 204, 0.5);
            color: #e2e8f0;
            box-shadow: 0 4px 12px rgba(25, 119, 204, 0.3);
        }

        [data-theme="dark"] .theme-toggle:hover {
            background: rgba(25, 119, 204, 0.4);
            border-color: rgba(96, 165, 250, 0.7);
            color: #ffffff;
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 6px 20px rgba(25, 119, 204, 0.5);
        }

        [data-theme="dark"] #header.header-scrolled .theme-toggle {
            background: linear-gradient(135deg, rgba(25, 119, 204, 0.2) 0%, rgba(96, 165, 250, 0.2) 100%);
            border-color: rgba(96, 165, 250, 0.5);
            color: #60a5fa;
            box-shadow: 0 2px 8px rgba(25, 119, 204, 0.3);
        }

        [data-theme="dark"] #header.header-scrolled .theme-toggle:hover {
            background: linear-gradient(135deg, #1977cc 0%, #60a5fa 100%);
            border-color: #60a5fa;
            color: #ffffff;
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 6px 20px rgba(25, 119, 204, 0.6);
        }

        main {
            padding-top: 80px;
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

    // Mobile nav toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
        const navbar = document.querySelector('#navbar');
        
        if (mobileNavToggle) {
            mobileNavToggle.addEventListener('click', function() {
                navbar.classList.toggle('mobile-nav-active');
            });
        }

        // Header scroll effect
        const header = document.querySelector('#header');
        if (header) {
            // Проверяем начальное положение
            if (window.scrollY <= 100) {
                header.classList.remove('header-scrolled');
            } else {
                header.classList.add('header-scrolled');
            }
            
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            });
        }

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
</body>
</html>
