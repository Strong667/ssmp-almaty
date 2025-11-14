@extends('frontend.layouts.app')

@section('title', $news->title)

@section('content')
    <section class="section">
        <div class="container">
            <article class="news-detail">
                @if($news->image_url)
                    <div class="news-detail-img">
                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="img-fluid">
                    </div>
                @endif
                
                <header class="news-detail-header">
                    <h1 class="news-detail-title">{{ $news->title }}</h1>
                    <p class="news-detail-date">{{ $news->display_date }}</p>
                </header>

                <div class="news-detail-content">
                    {!! $news->description !!}
                </div>

                @if($news->video_url)
                    <div class="news-detail-video">
                        <iframe
                            width="100%"
                            height="500"
                            src="{{ $news->video_url }}"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif

                <div class="news-detail-back">
                    <a href="{{ route('news.list') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Вернуться к списку новостей
                    </a>
                </div>
            </article>
        </div>
    </section>

    @push('styles')
    <style>
        .news-detail {
            max-width: 900px;
            margin: 0 auto;
        }

        .news-detail-img {
            margin-bottom: 30px;
            border-radius: 10px;
            overflow: hidden;
        }

        .news-detail-img img {
            width: 100%;
            height: auto;
            display: block;
        }

        .news-detail-header {
            margin-bottom: 30px;
        }

        .news-detail-title {
            font-size: 36px;
            font-weight: 700;
            margin: 0 0 15px 0;
            color: #2c4964;
        }

        .news-detail-date {
            color: #6c757d;
            font-size: 16px;
            margin: 0;
        }

        .news-detail-content {
            font-size: 18px;
            line-height: 1.8;
            color: #2c4964;
            margin-bottom: 30px;
        }

        .news-detail-video {
            margin: 40px 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .news-detail-back {
            margin-top: 40px;
        }

        [data-theme="dark"] .news-detail-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .news-detail-content {
            color: #e0e0e0;
        }

        [data-theme="dark"] .news-detail-date {
            color: #b0b0b0;
        }
    </style>
    @endpush
@endsection

