@extends('frontend.layouts.app')

@section('title', 'Государственный Герб')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.state_emblem') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- State Emblem Section -->
    <section class="state-emblem section">
        <div class="container">
            @if($item)
                <div class="row">
                    <div class="col-12">
                        <div class="symbol-card">
                            @if($item->image_url)
                                <div class="symbol-image-wrapper">
                                    <img src="{{ $item->image_url }}" alt="Государственный Герб" class="symbol-image">
                                </div>
                            @endif

                            @if($item->description)
                                <div class="symbol-description">
                                    {!! nl2br(e($item->description)) !!}
                                </div>
                            @endif
                        </div>
                    </div>
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

        /* State Emblem Section */
        .state-emblem {
            padding: 40px 0;
            background: #fff;
        }

        .symbol-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.3s ease;
        }

        .symbol-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .symbol-image-wrapper {
            width: 100%;
            margin-bottom: 25px;
            text-align: center;
        }

        .symbol-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .symbol-description {
            font-size: 15px;
            line-height: 1.7;
            color: #495057;
        }

        .symbol-description p {
            margin-bottom: 15px;
        }

        .symbol-description p:last-child {
            margin-bottom: 0;
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
            color: #FFC107;
        }

        [data-theme="dark"] .breadcrumb-item.active {
            color: #e0e0e0;
        }

        [data-theme="dark"] .breadcrumb-item::after {
            color: #495057;
        }

        [data-theme="dark"] .state-emblem {
            background: #1a1a1a;
        }

        [data-theme="dark"] .symbol-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .symbol-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .symbol-description {
            color: #adb5bd;
        }

        @media (max-width: 768px) {
            .symbol-card {
                padding: 20px;
            }
        }
    </style>
    @endpush
@endsection

