<footer id="footer" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <!-- Левая колонка: Контактная информация -->
                <div class="col-lg-4 col-md-6 footer-contact">
                    <div class="footer-contact-item">
                        <h5>{{ __('frontend.footer.office') }}</h5>
                        <div class="contact-info">
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:info@ssmp-almaty.kz">info@ssmp-almaty.kz</a>
                        </div>
                    </div>

                    <div class="footer-contact-item">
                        <h5>{{ __('frontend.footer.patient_support') }}</h5>
                        <div class="contact-info">
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:info@ssmp-almaty.kz">info@ssmp-almaty.kz</a>
                        </div>
                    </div>

                    <div class="footer-contact-item">
                        <h5>{{ __('frontend.footer.call_center') }}</h5>
                        <div class="contact-info">
                            <span class="contact-hours">{{ __('frontend.footer.working_hours') }}</span>
                        </div>
                        <div class="contact-info">
                            <i class="bi bi-telephone"></i>
                            <a href="tel:+77272794614">+7 (727) 279-46-14</a>
                        </div>
                    </div>

                    <div class="footer-contact-item">
                        <h5>{{ __('frontend.footer.whatsapp_call_center') }}</h5>
                        <div class="contact-info">
                            <i class="bi bi-whatsapp"></i>
                            <a href="https://wa.me/77273000505" target="_blank">+7 (727) 300-05-05</a>
                        </div>
                    </div>
                </div>

                <!-- Средняя колонка: Навигация -->
                <div class="col-lg-4 col-md-6 footer-links">
                    <ul class="footer-nav">
                        <li><a href="{{ route('substations.index') }}">{{ __('frontend.footer.departments') }}</a></li>
                        <li><a href="https://almatyzdrav.kz/outreach/helpline/" target="_blank">{{ __('frontend.footer.unified_medical_call_center') }}</a></li>
                        <li><a href="{{ route('questions.index') }}">{{ __('frontend.footer.leave_feedback') }}</a></li>
                        <li><a href="{{ route('home') }}#contact">{{ __('frontend.footer.contacts') }}</a></li>
                    </ul>
                </div>

                <!-- Правая колонка: Информация о больнице -->
                <div class="col-lg-4 col-md-12 footer-info">
                    <div class="footer-info-content">
                        <ul class="footer-nav">
                            <li><a href="https://egov.kz" target="_blank">{{ __('frontend.footer.e_government') }}</a></li>
                        </ul>

                        <div class="footer-logo-section">
                            <div class="footer-logo-wrapper">
                                <div class="footer-logo">
                                    <img src="{{ asset('slujba.png') }}" alt="Логотип">
                                </div>
                                <div class="footer-hospital-name">
                                    <div class="hospital-name-line">{{ __('frontend.footer.hospital_name_line1') }}</div>
                                    <div class="hospital-name-line">{{ __('frontend.footer.hospital_name_line2') }}</div>
                                    <div class="hospital-name-line">{{ __('frontend.footer.hospital_name_line3') }}</div>
                                    <div class="hospital-name-line">{{ __('frontend.footer.hospital_name_line4') }}</div>
                                </div>
                            </div>
                            <div class="footer-social">
                                <a href="#" target="_blank" aria-label="Instagram" class="footer-social-link">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="#" target="_blank" aria-label="Facebook" class="footer-social-link">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </div>
                            <div class="footer-address">
                                <strong>{{ __('frontend.footer.address') }}</strong>
                            </div>
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; {{ date('Y') }} <strong><span>{{ __('frontend.footer.medical_center') }}</span></strong>. {{ __('frontend.footer.all_rights_reserved') }}.
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<a href="#" id="back-to-top" class="back-to-top d-flex align-items-center justify-content-center" aria-label="{{ __('frontend.footer.back_to_top') }}">
    <i class="bi bi-arrow-up"></i>
</a>
