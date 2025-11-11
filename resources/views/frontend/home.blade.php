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
    </style>
@endsection
