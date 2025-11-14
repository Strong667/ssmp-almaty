@extends('frontend.layouts.app')

@section('title', 'Главная')

@section('content')
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
                                    <a href="{{ route('news.detail', $article->slug) }}" class="read-more">
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
