<header class="text-white" style="background: linear-gradient(135deg, #0e7d9d 0%, #0a567c 100%);">
    <div class="container py-3 text-white">
        <div class="row align-items-center g-0">
            <div class="col-12 col-lg-auto d-flex justify-content-center justify-content-lg-start">
                <a href="{{ route('home') }}" class="navbar-brand d-inline-flex p-0">
                    <img src="{{ asset('slujba.png') }}" alt="Логотип" style="width: 150px; height: 150px; object-fit: contain;">
                </a>
            </div>

            <div class="col-12 col-lg d-flex justify-content-center justify-content-lg-end align-items-center gap-3 ps-lg-3">
                <select class="form-select form-select-sm bg-transparent text-white border-0 border-bottom border-light border-opacity-50 rounded-0 px-0" style="max-width: 90px;">
                    <option value="ru" selected>RU</option>
                    <option value="kz">KZ</option>
                </select>
                <form class="input-group input-group-sm text-dark" role="search" style="max-width: 240px;">
                    <input class="form-control border-0 border-bottom rounded-0 px-0" type="search" placeholder="Поиск" aria-label="Поиск">
                    <button class="btn btn-link text-white px-2" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark border-top border-light border-opacity-25">
        <div class="container">
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Переключить навигацию">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center py-2" id="mainNavbar">
                <ul class="navbar-nav gap-lg-3 text-uppercase small fw-semibold">
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('home') ? ' active' : '' }}" href="{{ route('home') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Антикор. служба</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Для населения</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Гос. закупки</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Гос. услуги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Гос. символы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
