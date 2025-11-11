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
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.5s ease;
            z-index: 997;
            padding: 15px 0;
            box-shadow: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        #header.fixed-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        #header.header-scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
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
        }

        #navbar .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        #navbar .dropdown-menu li {
            width: 100%;
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
            font-weight: 500;
            color: #fff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            white-space: nowrap;
            transition: 0.3s;
        }

        #header.header-scrolled #navbar a,
        #header.header-scrolled #navbar a:focus {
            color: #2c4964;
            text-shadow: none;
        }

        #navbar a:hover,
        #navbar .active,
        #navbar .active:focus {
            color: #fff;
        }

        #header.header-scrolled #navbar a:hover,
        #header.header-scrolled #navbar .active,
        #header.header-scrolled #navbar .active:focus {
            color: #1977cc;
        }

        [data-theme="dark"] #navbar .dropdown-menu {
            background: rgba(26, 26, 26, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] #navbar .dropdown-menu .nav-link {
            color: #e0e0e0;
        }

        [data-theme="dark"] #navbar .dropdown-menu .nav-link:hover {
            background: rgba(25, 119, 204, 0.2);
            color: #1977cc;
        }

        [data-theme="dark"] #header {
            background: rgba(26, 26, 26, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        [data-theme="dark"] #header.header-scrolled {
            background: rgba(26, 26, 26, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] #navbar a,
        [data-theme="dark"] #navbar a:focus {
            color: #fff;
        }

        [data-theme="dark"] #header.header-scrolled #navbar a,
        [data-theme="dark"] #header.header-scrolled #navbar a:focus {
            color: #e0e0e0;
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
