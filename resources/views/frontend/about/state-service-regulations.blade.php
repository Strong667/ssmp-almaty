@extends('frontend.layouts.app')

@section('title', 'Регламенты государственных услуг')

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
                    <li class="breadcrumb-item active" aria-current="page">Регламенты государственных услуг</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- State Service Regulations Section -->
    <section class="state-service-regulations section">
        <div class="container">
            @if($items->isNotEmpty())
                <div class="row gy-4">
                    @foreach($items as $item)
                        <div class="col-12">
                            <div class="info-card">
                                <div class="info-content">
                                    @if($item->text)
                                        @if($item->url)
                                            <p>
                                                <a href="{{ $item->url }}" target="_blank" class="info-link">
                                                    {!! nl2br(e($item->text)) !!}
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                </a>
                                            </p>
                                        @else
                                            <p>{!! nl2br(e($item->text)) !!}</p>
                                        @endif
                                    @elseif($item->url)
                                        <p>
                                            <a href="{{ $item->url }}" target="_blank" class="info-link">
                                                {{ $item->url }}
                                                <i class="bi bi-box-arrow-up-right"></i>
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Информация пока не добавлена</p>
                        </div>
                    </div>
                </div>
            @endif
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
            color: #0d9488;
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

        /* State Service Regulations Section */
        .state-service-regulations {
            padding: 40px 0;
            background: #fff;
        }

        .info-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .info-content {
            font-size: 15px;
            line-height: 1.7;
            color: #495057;
        }

        .info-content p {
            margin-bottom: 15px;
        }

        .info-content p:last-child {
            margin-bottom: 0;
        }

        .info-link {
            color: #0d9488;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .info-link:hover {
            color: #0b7d73;
        }

        .info-link i {
            font-size: 14px;
        }

        .alert {
            padding: 30px;
            border-radius: 10px;
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            color: #004085;
        }

        .alert i {
            font-size: 24px;
            margin-right: 10px;
        }

        [data-theme="dark"] .breadcrumbs-section {
            background: #1a1a1a;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .breadcrumb-item a {
            color: #adb5bd;
        }

        [data-theme="dark"] .breadcrumb-item a:hover {
            color: #0d9488;
        }

        [data-theme="dark"] .breadcrumb-item.active {
            color: #e0e0e0;
        }

        [data-theme="dark"] .breadcrumb-item::after {
            color: #495057;
        }

        [data-theme="dark"] .state-service-regulations {
            background: #1a1a1a;
        }

        [data-theme="dark"] .info-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .info-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .info-content {
            color: #adb5bd;
        }

        @media (max-width: 768px) {
            .info-card {
                padding: 20px;
            }
        }
    </style>
    @endpush
@endsection

