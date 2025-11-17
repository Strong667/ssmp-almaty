<footer id="footer" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <!-- Левая колонка: Контактная информация -->
                <div class="col-lg-4 col-md-6 footer-contact">
                    <div class="footer-contact-item">
                        <h5>КАНЦЕЛЯРИЯ</h5>
                        <div class="contact-info">
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:Kgpssmp@ssmp-almaty.kz">Kgpssmp@ssmp-almaty.kz</a>
                        </div>
                    </div>

                    <div class="footer-contact-item">
                        <h5>СЛУЖБА ПОДДЕРЖКИ ПАЦИЕНТА И ВНУТРЕННЕГО КОНТРОЛЯ (АУДИТ)</h5>
                        <div class="contact-info">
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:Kgpssmp@ssmp-almaty.kz">Kgpssmp@ssmp-almaty.kz</a>
                        </div>
                    </div>

                    <div class="footer-contact-item">
                        <h5>CALL-ЦЕНТР</h5>
                        <div class="contact-info">
                            <span class="contact-hours">Пн-Пт 8:00-17:00</span>
                        </div>
                        <div class="contact-info">
                            <i class="bi bi-telephone"></i>
                            <a href="tel:+77272794614">+7 (727) 279-46-14</a>
                        </div>
                    </div>

                    <div class="footer-contact-item">
                        <h5>WHATSAPP CALL-ЦЕНТР</h5>
                        <div class="contact-info">
                            <i class="bi bi-whatsapp"></i>
                            <a href="https://wa.me/77273000505" target="_blank">+7 (727) 300-05-05</a>
                        </div>
                    </div>
                </div>

                <!-- Средняя колонка: Навигация -->
                <div class="col-lg-4 col-md-6 footer-links">
                    <ul class="footer-nav">
                        <li><a href="{{ route('substations.index') }}">ОТДЕЛЕНИЯ</a></li>
                        <li><a href="https://almatyzdrav.kz/outreach/helpline/" target="_blank">ЕДИНЫЙ МЕДИЦИНСКИЙ CALL ЦЕНТР</a></li>
                        <li><a href="{{ route('questions.index') }}">ОСТАВИТЬ ОТЗЫВ / ЗАДАТЬ ВОПРОС</a></li>
                        <li><a href="{{ route('home') }}#contact">КОНТАКТЫ</a></li>
                    </ul>
                </div>

                <!-- Правая колонка: Информация о больнице -->
                <div class="col-lg-4 col-md-12 footer-info">
                    <div class="footer-info-content">
                        <ul class="footer-nav">
                            <li><a href="https://egov.kz" target="_blank">ЭЛЕКТРОННОЕ ПРАВИТЕЛЬСТВО</a></li>
                        </ul>

                        <div class="footer-logo-section">
                            <div class="footer-logo-wrapper">
                                <div class="footer-logo">
                                    <img src="{{ asset('slujba.png') }}" alt="Логотип">
                                </div>
                                <div class="footer-hospital-name">
                                    <div class="hospital-name-line">ЦЕНТРАЛЬНАЯ</div>
                                    <div class="hospital-name-line">ГОРОДСКАЯ</div>
                                    <div class="hospital-name-line">КЛИНИЧЕСКАЯ</div>
                                    <div class="hospital-name-line">БОЛЬНИЦА</div>
                                </div>
                            </div>
                            <div class="footer-address">
                                <strong>АЛМАТЫ, УЛ. КАЗЫБЕК БИ, 115</strong>
                            </div>
                        </div>
                </div>
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
