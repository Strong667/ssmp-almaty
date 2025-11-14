@extends('frontend.layouts.app')

@section('title', 'Перечень коррупционных рисков')

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
                    <li class="breadcrumb-item active" aria-current="page">Перечень коррупционных рисков</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Corruption Risk List Section -->
    <section class="corruption-risk-list section">
        <div class="container">
            @if($lists->isNotEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="documents-card">
                            <ul class="documents-list">
                                @foreach($lists as $list)
                                    @if($list->file_url)
                                        <li class="document-item">
                                            <a href="{{ $list->file_url }}" target="_blank" class="document-link">
                                                <div class="document-icon">
                                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                                </div>
                                                <div class="document-content">
                                                    <h4 class="document-title">{{ $list->title }}</h4>
                                                </div>
                                                <div class="document-arrow">
                                                    <i class="bi bi-chevron-right"></i>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
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

        /* Corruption Risk List Section */
        .corruption-risk-list {
            padding: 40px 0;
            background: #fff;
        }

        .documents-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .documents-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .document-item {
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 15px;
        }

        .document-item:last-child {
            margin-bottom: 0;
            border-bottom: none;
            padding-bottom: 0;
        }

        .document-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .document-link:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .document-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
            background: #0d9488;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .document-content {
            flex-grow: 1;
        }

        .document-title {
            font-size: 18px;
            font-weight: 600;
            color: #212529;
            margin: 0;
            font-family: "Montserrat", sans-serif;
        }

        .document-arrow {
            color: #6c757d;
            font-size: 20px;
        }

        .document-link:hover .document-arrow {
            color: #0d9488;
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

        [data-theme="dark"] .corruption-risk-list {
            background: #1a1a1a;
        }

        [data-theme="dark"] .documents-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .document-item {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .document-link {
            background: #1a1a1a;
        }

        [data-theme="dark"] .document-link:hover {
            background: #2a2a2a;
        }

        [data-theme="dark"] .document-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .document-arrow {
            color: #adb5bd;
        }

        @media (max-width: 768px) {
            .documents-card {
                padding: 20px;
            }

            .document-link {
                padding: 12px;
            }

            .document-icon {
                width: 40px;
                height: 40px;
                min-width: 40px;
                font-size: 18px;
            }

            .document-title {
                font-size: 16px;
            }
        }
    </style>
    @endpush
@endsection

