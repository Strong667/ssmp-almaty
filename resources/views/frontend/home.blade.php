@extends('frontend.layouts.app')

@section('title', 'Главная')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Медицинский центр</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Профессиональная медицинская помощь для вашего здоровья</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Узнать больше</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('slujba.png') }}" class="img-fluid" alt="Медицинский центр">
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    @if($news->isNotEmpty())
        <section id="news" class="news section">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>НОВОСТИ</h2>
                    <p>Актуальные события и новости медицинского центра</p>
                </header>

                <div class="row gy-4">
                    @foreach($news as $article)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-box">
                                @if($article->image_url)
                                    <div class="news-img">
                                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="img-fluid">
                                    </div>
                                @endif
                                <div class="news-content">
                                    <h3 class="news-title">{{ $article->title }}</h3>
                                    <p class="news-date">{{ $article->display_date }}</p>
                                    <a href="#" class="read-more">
                                        <span>Читать Новость</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Media Section -->
    <section id="media" class="media section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="media-box">
                        <div class="media-content">
                            <h3>Видео</h3>
                            <div class="media-embed">
                        <iframe
                            width="100%"
                            height="100%"
                            src="https://www.youtube.com/embed/videoseries?list=PLsaGgmCCSu8VucnlqRDRA-637FOrsBy1o"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="media-box">
                        <div class="media-content">
                            <h3>Карта</h3>
                            <div class="media-embed">
                        <iframe
                            src="https://yandex.ru/map-widget/v1/?um=constructor%3A984a0c4f628d41f0563e1e4becea1dd9bfe4ad7ec66d31d1ad0418b2232d4e74&source=constructor"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
            </div>
            </div>
    </section>

    <!-- Gallery Section -->
    @if($images->isNotEmpty())
        <section id="gallery" class="gallery section">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>Галерея</h2>
                    <p>Фотографии из жизни медицинского центра</p>
                </header>

                <div class="gallery-carousel">
                    @foreach($images->merge($images) as $index => $item)
                        <div class="gallery-item">
                            <img src="{{ $item['url'] }}" alt="Изображение галереи #{{ ($index % $images->count()) + 1 }}" class="img-fluid">
            </div>
                    @endforeach
                            </div>
            </div>
        </section>
    @endif

    @push('styles')
    <style>

        /* Hero Section */
        #hero {
            width: 100%;
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding-top: 120px;
            position: relative;
            overflow: hidden;
        }

        #hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                /* Точки сетки - мелкие */
                radial-gradient(circle, rgba(255, 255, 255, 0.2) 1.5px, transparent 1.5px),
                /* Точки сетки - средние */
                radial-gradient(circle, rgba(255, 255, 255, 0.15) 2px, transparent 2px),
                /* Точки сетки - крупные */
                radial-gradient(circle, rgba(255, 255, 255, 0.1) 3px, transparent 3px);
            background-size: 
                40px 40px,
                80px 80px,
                160px 160px;
            background-position: 
                0 0,
                20px 20px,
                40px 40px;
            opacity: 0.5;
            pointer-events: none;
        }

        #hero::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 70%;
            height: 100%;
            background-image: 
                /* Шестиугольники - создаем через clip-path и градиенты */
                repeating-linear-gradient(
                    0deg,
                    transparent 0px,
                    transparent 48px,
                    rgba(255, 255, 255, 0.08) 48px,
                    rgba(255, 255, 255, 0.08) 50px,
                    transparent 50px,
                    transparent 98px
                ),
                repeating-linear-gradient(
                    60deg,
                    transparent 0px,
                    transparent 48px,
                    rgba(255, 255, 255, 0.08) 48px,
                    rgba(255, 255, 255, 0.08) 50px,
                    transparent 50px,
                    transparent 98px
                ),
                repeating-linear-gradient(
                    120deg,
                    transparent 0px,
                    transparent 48px,
                    rgba(255, 255, 255, 0.08) 48px,
                    rgba(255, 255, 255, 0.08) 50px,
                    transparent 50px,
                    transparent 98px
                ),
                /* Дополнительные линии для соединения */
                repeating-linear-gradient(
                    30deg,
                    transparent 0px,
                    transparent 84px,
                    rgba(255, 255, 255, 0.05) 84px,
                    rgba(255, 255, 255, 0.05) 86px,
                    transparent 86px,
                    transparent 170px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent 0px,
                    transparent 84px,
                    rgba(255, 255, 255, 0.05) 84px,
                    rgba(255, 255, 255, 0.05) 86px,
                    transparent 86px,
                    transparent 170px
                );
            background-size: 
                100px 87px,
                100px 87px,
                100px 87px,
                173px 150px,
                173px 150px;
            background-position: 
                0 0,
                50px 43.5px,
                25px 87px,
                0 0,
                86.5px 75px;
            opacity: 0.4;
            transform: perspective(1200px) rotateX(50deg) rotateY(-10deg) scale(1.3);
            transform-origin: right center;
            pointer-events: none;
            filter: blur(0.5px);
        }

        #hero .container {
            position: relative;
            z-index: 2;
        }

        [data-theme="dark"] #hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }

        [data-theme="dark"] #hero::before {
            background-image: 
                radial-gradient(circle, rgba(255, 255, 255, 0.1) 1.5px, transparent 1.5px),
                radial-gradient(circle, rgba(255, 255, 255, 0.08) 2px, transparent 2px),
                radial-gradient(circle, rgba(255, 255, 255, 0.05) 3px, transparent 3px);
        }

        [data-theme="dark"] #hero::after {
            background-image: 
                repeating-linear-gradient(
                    0deg,
                    transparent 0px,
                    transparent 48px,
                    rgba(255, 255, 255, 0.05) 48px,
                    rgba(255, 255, 255, 0.05) 50px,
                    transparent 50px,
                    transparent 98px
                ),
                repeating-linear-gradient(
                    60deg,
                    transparent 0px,
                    transparent 48px,
                    rgba(255, 255, 255, 0.05) 48px,
                    rgba(255, 255, 255, 0.05) 50px,
                    transparent 50px,
                    transparent 98px
                ),
                repeating-linear-gradient(
                    120deg,
                    transparent 0px,
                    transparent 48px,
                    rgba(255, 255, 255, 0.05) 48px,
                    rgba(255, 255, 255, 0.05) 50px,
                    transparent 50px,
                    transparent 98px
                ),
                repeating-linear-gradient(
                    30deg,
                    transparent 0px,
                    transparent 84px,
                    rgba(255, 255, 255, 0.03) 84px,
                    rgba(255, 255, 255, 0.03) 86px,
                    transparent 86px,
                    transparent 170px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent 0px,
                    transparent 84px,
                    rgba(255, 255, 255, 0.03) 84px,
                    rgba(255, 255, 255, 0.03) 86px,
                    transparent 86px,
                    transparent 170px
                );
        }

        #hero h1 {
            margin: 0 0 10px 0;
            font-size: 48px;
            font-weight: 700;
            line-height: 56px;
            color: #fff;
        }

        #hero h2 {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 50px;
            font-size: 24px;
        }

        .btn-get-started {
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-size: 16px;
            letter-spacing: 1px;
            display: inline-block;
            padding: 12px 36px;
            border-radius: 50px;
            transition: 0.5s;
            color: #fff;
            border: 2px solid #fff;
            text-decoration: none;
        }

        .btn-get-started:hover {
            background: #fff;
            color: #667eea;
        }

        .hero-img {
            text-align: right;
        }

        .hero-img img {
            width: 100%;
            max-width: 500px;
        }

        /* News Section */
        .news {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            padding-bottom: 40px;
        }

        .section-header h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2c4964;
        }

        .section-header p {
            margin: 0;
            color: #6c757d;
            font-size: 18px;
        }

        .news-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .news-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
        }

        .news-img {
            overflow: hidden;
            height: 250px;
        }

        .news-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .news-box:hover .news-img img {
            transform: scale(1.1);
        }

        .news-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .news-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 15px 0;
            color: #2c4964;
            line-height: 1.4;
        }

        .news-date {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            color: #1977cc;
            text-decoration: none;
            font-weight: 500;
            margin-top: auto;
        }

        .read-more:hover {
            color: #0d5aa7;
        }

        .read-more i {
            margin-left: 5px;
            transition: 0.3s;
        }

        .read-more:hover i {
            transform: translateX(5px);
        }

        /* Media Section */
        .media {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .media-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            height: 100%;
        }

        .media-content {
            padding: 30px;
        }

        .media-content h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2c4964;
        }

        .media-embed {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 8px;
        }

        .media-embed iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Gallery Section */
        .gallery {
            padding: 80px 0;
        }

        .gallery-carousel {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px 0;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .gallery-carousel::-webkit-scrollbar {
            height: 6px;
        }

        .gallery-carousel::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .gallery-carousel::-webkit-scrollbar-thumb {
            background: #1977cc;
            border-radius: 10px;
        }

        .gallery-item {
            flex: 0 0 auto;
            width: 400px;
            height: 300px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Dark Theme for Home Page Sections */
        [data-theme="dark"] .news {
            background: #1a1a1a;
        }

        [data-theme="dark"] .news-box {
            background: #2a2a2a;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .news-box:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] .news-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .news-date {
            color: #b0b0b0;
        }

        [data-theme="dark"] .media {
            background: #222222;
        }

        [data-theme="dark"] .media-box {
            background: #2a2a2a;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .media-content h3 {
            color: #e0e0e0;
        }

        [data-theme="dark"] .gallery {
            background: #1a1a1a;
        }

        /* Responsive */
        @media (max-width: 991px) {
            #hero {
                height: auto;
                padding: 120px 0 60px;
            }

            #hero h1 {
                font-size: 32px;
                line-height: 40px;
            }

            #hero h2 {
                font-size: 20px;
            }

            .hero-img {
                text-align: center;
                margin-top: 40px;
            }

            .section-header h2 {
                font-size: 28px;
            }

            .gallery-item {
                width: 300px;
                height: 225px;
            }
        }
    </style>
    @endpush
@endsection
