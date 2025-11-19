@extends('frontend.layouts.app')

@section('title', $item->title)

@section('content')
    <!-- Breadcrumbs Section -->
    <section class="breadcrumbs-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <i class="bi bi-house-door"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('about.rubric-for-population') }}">Рубрика для населения</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $item->title }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Rubric Detail Section -->
    <section class="rubric-detail section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rubric-detail-card">
                        <h2 class="rubric-detail-title">{{ $item->title }}</h2>

                        @if($item->image_url)
                            <div class="rubric-detail-image">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="img-fluid">
                            </div>
                        @endif

                        @if($item->description)
                            <div class="rubric-detail-description">
                                {!! nl2br(e($item->description)) !!}
                            </div>
                        @endif

                        @if($item->type === 'text' && $item->content)
                            <div class="rubric-detail-content">
                                {!! nl2br(e($item->content)) !!}
                            </div>
                        @elseif($item->type === 'pdf' && $item->file_url)
                            <div class="rubric-detail-pdf">
                                <div class="pdf-wrapper">
                                    <object data="{{ $item->file_url }}" type="application/pdf" width="100%" height="600">
                                        <iframe
                                            src="{{ $item->file_url }}"
                                            width="100%"
                                            height="600"
                                            style="border: none;"
                                        >
                                            <p>Ваш браузер не поддерживает отображение PDF. 
                                                <a href="{{ $item->file_url }}" download>Скачайте файл</a>.
                                            </p>
                                        </iframe>
                                    </object>
                                </div>
                            </div>
                        @elseif($item->type === 'video' && $item->embed_url)
                            <div class="rubric-detail-video">
                                <div class="video-wrapper">
                                    <iframe
                                        width="100%"
                                        height="100%"
                                        src="{{ $item->embed_url }}"
                                        frameborder="0"
                                        allow="autoplay; encrypted-media"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                        @elseif($item->type === 'images' && $item->file_url)
                            <div class="rubric-detail-images">
                                <div class="image-item">
                                    <img src="{{ $item->file_url }}" alt="{{ $item->title }}" class="img-fluid">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
    <style>
        /* Breadcrumbs Section */
        .breadcrumbs-section {
            padding: 15px 0;
            background: #f8f9fa;
            border-bottom: 1px solid #e5e7eb;
        }

        .breadcrumb {
            margin: 0;
            padding: 0;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: color 0.2s ease;
        }

        .breadcrumb-item a:hover {
            color: #FFC107;
        }

        .breadcrumb-item.active {
            color: #2c4964;
            font-weight: 500;
        }

        .breadcrumb-item::after {
            content: '>';
            margin: 0 8px;
            color: #adb5bd;
        }

        .breadcrumb-item:last-child::after {
            display: none;
        }

        .breadcrumb-item i {
            font-size: 16px;
        }

        /* Rubric Detail Section */
        .rubric-detail {
            padding: 40px 0;
            background: #fff;
        }

        .rubric-detail-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .rubric-detail-title {
            font-size: 28px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 25px 0;
            font-family: "Montserrat", sans-serif;
        }

        .rubric-detail-image {
            margin-bottom: 25px;
        }

        .rubric-detail-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .rubric-detail-description {
            font-size: 16px;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 25px;
        }

        .rubric-detail-content {
            font-size: 15px;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 25px;
        }

        .rubric-detail-pdf {
            margin-bottom: 25px;
        }

        .pdf-wrapper {
            width: 100%;
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .pdf-wrapper iframe {
            width: 100%;
            height: 600px;
            border: none;
        }

        .pdf-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .pdf-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #FFC107;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .pdf-link:hover {
            background: #d4a000;
            color: #fff;
        }

        .pdf-link-secondary {
            background: #6c757d;
        }

        .pdf-link-secondary:hover {
            background: #d4a000;
        }

        .rubric-detail-video {
            margin-bottom: 25px;
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .rubric-detail-images {
            margin-bottom: 25px;
        }

        .image-item {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .image-item img {
            width: 100%;
            height: auto;
            display: block;
        }

        [data-theme="dark"] .breadcrumbs-section {
            background: #1a1a1a;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .breadcrumb-item a {
            color: #adb5bd;
        }

        [data-theme="dark"] .breadcrumb-item a:hover {
            color: #FFC107;
        }

        [data-theme="dark"] .breadcrumb-item.active {
            color: #e0e0e0;
        }

        [data-theme="dark"] .breadcrumb-item::after {
            color: #495057;
        }

        [data-theme="dark"] .rubric-detail {
            background: #1a1a1a;
        }

        [data-theme="dark"] .rubric-detail-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .rubric-detail-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .rubric-detail-description,
        [data-theme="dark"] .rubric-detail-content {
            color: #adb5bd;
        }

        @media (max-width: 768px) {
            .rubric-detail-card {
                padding: 20px;
            }

            .rubric-detail-title {
                font-size: 24px;
            }

            .pdf-wrapper iframe {
                height: 400px;
            }

            .pdf-actions {
                flex-direction: column;
            }

            .pdf-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @endpush
@endsection

