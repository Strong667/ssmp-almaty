@extends('frontend.layouts.app')

@section('title', 'Документы')

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
                    <li class="breadcrumb-item active" aria-current="page">Документы</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Documents Section -->
    <section class="documents section">
        <div class="container">
            @if($categories->isNotEmpty())
                @foreach($categories as $category)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="category-card">
                                <h3 class="category-title">
                                    <i class="bi bi-folder-fill"></i>
                                    {{ $category->title }}
                                </h3>
                                
                                @if($category->documents->isNotEmpty())
                                    <div class="documents-list">
                                        @foreach($category->documents as $document)
                                            <div class="document-item">
                                                <div class="document-icon">
                                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                                </div>
                                                <div class="document-content">
                                                    <h4 class="document-title">{{ $document->title }}</h4>
                                                    @if($document->file_url)
                                                        <div class="document-actions">
                                                            <a href="{{ $document->file_url }}" target="_blank" class="document-link">
                                                                <i class="bi bi-box-arrow-up-right"></i>
                                                                <span>Открыть в новой вкладке</span>
                                                            </a>
                                                            <a href="{{ $document->file_url }}" download class="document-link document-link-secondary">
                                                                <i class="bi bi-download"></i>
                                                                <span>Скачать файл</span>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle"></i>
                                        <span>Документов в этой категории пока нет</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Документы пока не добавлены</p>
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

        /* Documents Section */
        .documents {
            padding: 40px 0;
            background: #fff;
        }

        .category-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.3s ease;
        }

        .category-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .category-title {
            font-size: 24px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 25px 0;
            font-family: "Montserrat", sans-serif;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .category-title i {
            color: #0d9488;
            font-size: 28px;
        }

        .documents-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .document-item {
            display: flex;
            gap: 15px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .document-item:hover {
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
            margin: 0 0 12px 0;
            font-family: "Montserrat", sans-serif;
        }

        .document-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .document-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #0d9488;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .document-link:hover {
            background: #0b7d73;
            color: #fff;
        }

        .document-link-secondary {
            background: #6c757d;
        }

        .document-link-secondary:hover {
            background: #5a6268;
        }

        .alert {
            padding: 20px;
            border-radius: 8px;
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            color: #004085;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert i {
            font-size: 20px;
        }

        .alert.text-center {
            padding: 30px;
            justify-content: center;
        }

        .alert.text-center i {
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

        [data-theme="dark"] .documents {
            background: #1a1a1a;
        }

        [data-theme="dark"] .category-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .category-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .category-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .document-item {
            background: #1a1a1a;
        }

        [data-theme="dark"] .document-item:hover {
            background: #2a2a2a;
        }

        [data-theme="dark"] .document-title {
            color: #e0e0e0;
        }

        @media (max-width: 768px) {
            .category-title {
                font-size: 20px;
            }

            .category-card {
                padding: 20px;
            }

            .document-item {
                flex-direction: column;
                gap: 12px;
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

            .document-actions {
                flex-direction: column;
            }

            .document-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @endpush
@endsection

