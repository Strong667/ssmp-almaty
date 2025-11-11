<footer id="footer" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                        <img src="{{ asset('slujba.png') }}" alt="Логотип" style="max-height: 50px;">
                    </a>
                    <p>Медицинский центр, предоставляющий профессиональную медицинскую помощь для вашего здоровья и благополучия.</p>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Навигация</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Главная</a></li>
                        <li><a href="#about">О нас</a></li>
                        <li><a href="#services">Услуги</a></li>
                        <li><a href="#news">Новости</a></li>
                        <li><a href="#contact">Контакты</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-6 footer-contact">
                    <h4>Контакты</h4>
                    <p>
                        050000, Республика Казахстан, г. Алматы,<br>
                        Алмалинский район, улица Казыбек би, 115<br><br>
                        <strong>Телефон:</strong> +7 (727) 279-46-14<br>
                        <strong>Call-центр:</strong> +7 (727) 300-05-05<br>
                        <strong>Email:</strong> Kgpssmp@ssmp-almaty.kz<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-12 footer-links">
                    <h4>Полезные ссылки</h4>
                    <ul>
                        <li><a href="#">Антикор. служба</a></li>
                        <li><a href="#">Для населения</a></li>
                        <li><a href="#">Гос. закупки</a></li>
                        <li><a href="#">Гос. услуги</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; {{ date('Y') }} <strong><span>Медицинский центр</span></strong>. Все права защищены.
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<a href="#" id="back-to-top" class="back-to-top d-flex align-items-center justify-content-center" aria-label="Наверх">
    <i class="bi bi-arrow-up"></i>
</a>
