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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.documents') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Documents Section -->
    <section class="documents section">
        <div class="container">
            @if($categories->isNotEmpty())
                <div class="accordion" id="documentsAccordion">
                    @foreach($categories as $index => $category)
                        <div class="accordion-item document-accordion-item">
                            <h2 class="accordion-header" id="heading{{ $category->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="false" aria-controls="collapse{{ $category->id }}">
                                    <div class="category-title-wrapper">
                                        <i class="bi bi-folder-fill"></i>
                                        <span class="category-title-text">{{ $category->title }}</span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#documentsAccordion">
                                <div class="accordion-body">
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
                                                                <a href="{{ $document->file_url }}" download class="document-link">
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
                </div>
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

        /* Accordion Styles */
        #documentsAccordion {
            --bs-accordion-border-color: #e5e7eb;
            --bs-accordion-border-radius: 12px;
            --bs-accordion-inner-border-radius: 12px;
        }

        .document-accordion-item {
            border: none;
            margin-bottom: 16px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            background: #fff;
        }

        #documentsAccordion .accordion-button {
            background: #fff;
            border: none;
            padding: 20px 24px;
            font-weight: 500;
            color: #2c4964;
            font-size: 18px;
            box-shadow: none;
        }

        #documentsAccordion .accordion-button:not(.collapsed) {
            background: #f8f9fa;
            color: #2c4964;
            box-shadow: none;
        }

        #documentsAccordion .accordion-button:focus {
            border-color: transparent;
            box-shadow: none;
        }

        #documentsAccordion .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232c4964'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
            margin-left: auto;
            content: "";
            background-repeat: no-repeat;
            background-size: 1.25rem;
            transition: transform 0.2s ease-in-out;
        }

        #documentsAccordion .accordion-button:not(.collapsed)::after {
            transform: rotate(-180deg);
        }

        .category-title-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            text-align: left;
        }

        .category-title-wrapper i {
            color: #0d9488;
            font-size: 24px;
            flex-shrink: 0;
        }

        .category-title-text {
            font-size: 18px;
            font-weight: 600;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        #documentsAccordion .accordion-body {
            padding: 20px 24px !important;
            background: #fff !important;
            color: #2c4964 !important;
        }

        #documentsAccordion .accordion-collapse {
            background: #fff !important;
        }

        #documentsAccordion .accordion-body * {
            visibility: visible !important;
            opacity: 1 !important;
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

        [data-theme="dark"] .document-accordion-item {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] #documentsAccordion .accordion-button {
            background: #2a2a2a;
            color: #e0e0e0;
        }

        [data-theme="dark"] #documentsAccordion .accordion-button:not(.collapsed) {
            background: #333333;
            color: #e0e0e0;
        }

        [data-theme="dark"] #documentsAccordion .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23e0e0e0'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        [data-theme="dark"] .category-title-text {
            color: #e0e0e0;
        }

        [data-theme="dark"] #documentsAccordion .accordion-body {
            background: #2a2a2a !important;
            color: #e0e0e0 !important;
        }

        [data-theme="dark"] #documentsAccordion .accordion-collapse {
            background: #2a2a2a !important;
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
            .category-title-text {
                font-size: 16px;
            }

            .category-title-wrapper i {
                font-size: 20px;
            }

            #documentsAccordion .accordion-button {
                padding: 16px 20px;
                font-size: 16px;
            }

            #documentsAccordion .accordion-body {
                padding: 16px 20px !important;
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

