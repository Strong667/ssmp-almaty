@extends('frontend.layouts.app')

@section('title', 'Главная')

@section('content')
    <section class="hero position-relative overflow-hidden" style="background: transparent; box-shadow: none;">
        <div class="container-fluid px-0 mb-4">
            <div class="media-grid">
                <div class="media-grid__item">
                    <div class="custom-video h-100">
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
                <div class="media-grid__item">
                    <div class="custom-map h-100">
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
        @if($images->isNotEmpty())
            <div class="scroll-gallery d-flex gap-3">
                @foreach($images->merge($images) as $index => $item)
                    <div class="scroll-gallery__item">
                        <img src="{{ $item['url'] }}" alt="Изображение галереи #{{ ($index % $images->count()) + 1 }}">
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <h2 class="mb-3">Галерея скоро появится</h2>
                <p class="text-muted">Администратор пока не добавил изображения.</p>
            </div>
        @endif
    </section>

    @if($news->isNotEmpty())
        <section class="news-section px-3 px-lg-0">
            <div class="news-section__header text-center mb-4">
                <h2 class="fw-semibold">Последние новости</h2>
                <p class="text-muted mb-0">Подборка свежих материалов из административной панели</p>
            </div>
            <div class="news-grid">
                @foreach($news as $article)
                    <article class="news-card">
                        @if($article->image_url)
                            <div class="news-card__thumb">
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}">
                            </div>
                        @endif
                        <span class="news-date">
                            {{ $article->display_date }}
                        </span>
                        <h3>{{ $article->title }}</h3>
                        <p>{!! \Illuminate\Support\Str::limit(strip_tags($article->content), 160) !!}</p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <style>
        .media-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: min(2vw, 32px);
            width: min(1400px, 100vw);
            margin: 0 auto;
        }

        .media-grid__item {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(4, 30, 56, 0.18);
        }

        .custom-map,
        .custom-video {
            width: 100%;
            aspect-ratio: 21 / 9;
        }

        .custom-map iframe,
        .custom-video iframe {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 992px) {
            .media-grid {
                grid-template-columns: 1fr;
                width: min(1000px, 95vw);
            }
        }

        .scroll-gallery {
            animation: scrollGallery 60s linear infinite;
        }

        .scroll-gallery:hover {
            animation-play-state: paused;
        }

        .scroll-gallery__item {
            flex: 0 0 auto;
            width: min(420px, 90vw);
            aspect-ratio: 21 / 9;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(10, 70, 105, 0.18);
        }

        .scroll-gallery__item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .scroll-gallery__item:hover img {
            transform: scale(1.05);
        }

        @keyframes scrollGallery {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        @media (max-width: 992px) {
            .scroll-gallery {
                gap: 1.5rem;
            }

            .scroll-gallery__item {
                width: min(320px, 90vw);
                border-radius: 12px;
            }
        }

        .news-section {
            width: min(1400px, 100vw);
            margin: 3rem auto;
        }

        .news-section__header h2 {
            font-size: clamp(1.5rem, 1.2rem + 1vw, 2rem);
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: min(2vw, 26px);
        }

        .news-card {
            background: rgba(255, 255, 255, 0.92);
            border-radius: 20px;
            padding: 24px;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 18px 40px rgba(16, 33, 60, 0.18);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .news-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 45px rgba(16, 33, 60, 0.22);
        }

        .news-card__thumb {
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 14px;
            overflow: hidden;
        }

        .news-card__thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .news-card h3 {
            font-size: 1.1rem;
            margin: 0;
        }

        .news-card p {
            margin: 0;
            color: rgba(39, 55, 77, 0.82);
        }

        .news-date {
            font-size: 0.82rem;
            color: rgba(39, 55, 77, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        @media (max-width: 768px) {
            .news-card {
                padding: 20px;
            }
        }
    </style>
@endsection
