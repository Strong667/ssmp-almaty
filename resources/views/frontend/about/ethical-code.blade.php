@extends('frontend.layouts.app')

@section('title', 'Этический кодекс')

@section('content')
    <!-- Breadcrumbs Section -->
    <section class="breadcrumbs-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">{{ __('frontend.breadcrumbs.home') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> >> {{ __('frontend.menu.ethical_code') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Ethical Code Section -->
    <section class="ethical-code section">
        <div class="container">

            @if($ethicalCodes->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Документы этического кодекса пока не добавлены</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row gy-4">
                    @foreach($ethicalCodes as $ethicalCode)
                        <div class="col-12">
                            <div class="ethical-code-card">
                                <div class="ethical-code-header">
                                    <div class="ethical-code-icon">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                    </div>
                                    <div class="ethical-code-content">
                                        <h3 class="ethical-code-title">{{ $ethicalCode->localized_title }}</h3>
                                        @if($ethicalCode->localized_pdf_url)
                                            <div class="ethical-code-actions">
                                                <button type="button" class="ethical-code-link" onclick="openPdfSidebar('{{ $ethicalCode->localized_pdf_url }}', '{{ addslashes($ethicalCode->localized_title) }}')">
                                                    <i class="bi bi-eye"></i>
                                                    <span>Просмотр</span>
                                                </button>
                                                <a href="{{ $ethicalCode->localized_pdf_url }}" download class="ethical-code-link ethical-code-link-secondary">
                                                    <i class="bi bi-download"></i>
                                                    <span>Скачать PDF</span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- PDF Sidebar -->
    <div id="pdf-sidebar" class="pdf-sidebar">
        <div class="pdf-sidebar-overlay" onclick="closePdfSidebar()"></div>
        <div class="pdf-sidebar-content">
            <div class="pdf-sidebar-header">
                <h3 id="pdf-sidebar-title" class="pdf-sidebar-title"></h3>
                <button type="button" class="pdf-sidebar-close" onclick="closePdfSidebar()" aria-label="Закрыть">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="pdf-sidebar-body">
                <iframe id="pdf-sidebar-iframe" src="" class="pdf-sidebar-iframe" title="PDF Viewer"></iframe>
            </div>
        </div>
    </div>

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
        /* Убираем стандартный разделитель Bootstrap */
        .breadcrumb-item + .breadcrumb-item::before {
            display: none !important;
            content: none !important;
        }
        /* Добавляем отступ после >> */
        .breadcrumb-item:not(:first-child) {
            margin-left: 8px;
        }



        .breadcrumb-item i {
            font-size: 16px;
        }

        /* Ethical Code Section */
        .ethical-code {
            padding: 40px 0;
            background: #fff;
        }

        .ethical-code-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .ethical-code-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .ethical-code-header {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            align-items: flex-start;
        }

        .ethical-code-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            background: #FFC107;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .ethical-code-content {
            flex-grow: 1;
        }

        .ethical-code-title {
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 20px 0;
            color: #212529;
            line-height: 1.3;
            font-family: "Montserrat", sans-serif;
        }

        .ethical-code-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .ethical-code-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #FFC107;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .ethical-code-link:hover {
            background: #d4a000;
            color: #fff;
        }

        .ethical-code-link-secondary {
            background: #FFC107;
        }

        .ethical-code-link-secondary:hover {
            background: #d4a000;
        }

        .ethical-code-link i {
            font-size: 16px;
        }

        /* PDF Sidebar - Matching Mobile Menu Design */
        .pdf-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100vh;
            z-index: 99999;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            transition: visibility 0s linear 0.3s, opacity 0.3s ease;
        }

        .pdf-sidebar.active {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
            transition: visibility 0s linear 0s, opacity 0.3s ease;
        }

        .pdf-sidebar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pdf-sidebar.active .pdf-sidebar-overlay {
            opacity: 1;
        }

        .pdf-sidebar-content {
            position: absolute;
            top: 0;
            right: 0;
            width: 900px;
            max-width: 85vw;
            height: 100vh;
            background: rgba(44, 73, 100, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: -4px 0 24px rgba(0, 0, 0, 0.3);
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .pdf-sidebar.active .pdf-sidebar-content {
            transform: translateX(0);
        }

        .pdf-sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background: rgba(0, 0, 0, 0.35);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .pdf-sidebar-title {
            margin: 0;
            color: #FFC107;
            font-size: 20px;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
            text-transform: uppercase;
            flex: 1;
            padding-right: 20px;
        }

        .pdf-sidebar-close {
            background: transparent;
            border: none;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #FFC107;
            padding: 0;
            flex-shrink: 0;
        }

        .pdf-sidebar-close:hover {
            color: #fff;
            opacity: 0.8;
        }

        .pdf-sidebar-close i {
            font-size: 24px;
            font-weight: 400;
        }

        .pdf-sidebar-body {
            flex: 1;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.05);
        }

        .pdf-sidebar-iframe {
            width: 100%;
            height: 100%;
            border: none;
            background: #fff;
        }

        [data-theme="dark"] .pdf-sidebar-header {
            background: rgba(0, 0, 0, 0.4);
            border-bottom-color: rgba(255, 255, 255, 0.15);
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

        /* Dark Theme */
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
        /* Убираем стандартный разделитель Bootstrap */
        .breadcrumb-item + .breadcrumb-item::before {
            display: none !important;
            content: none !important;
        }
        /* Добавляем отступ после >> */
        .breadcrumb-item:not(:first-child) {
            margin-left: 8px;
        }


        [data-theme="dark"] .ethical-code {
            background: #1a1a1a;
        }

        [data-theme="dark"] .ethical-code-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .ethical-code-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .ethical-code-title {
            color: #e0e0e0;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .ethical-code-card {
                padding: 20px;
            }

            .ethical-code-header {
                flex-direction: column;
                gap: 15px;
            }

            .ethical-code-icon {
                width: 50px;
                height: 50px;
                min-width: 50px;
                font-size: 20px;
            }

            .ethical-code-title {
                font-size: 20px;
                margin-bottom: 15px;
            }

            .ethical-code-actions {
                flex-direction: column;
            }

            .ethical-code-link {
                width: 100%;
                justify-content: center;
                padding: 10px 16px;
                font-size: 14px;
            }

        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .pdf-sidebar-content {
                width: 100%;
                max-width: 100vw;
            }

            .pdf-sidebar-header {
                padding: 16px 20px;
            }

            .pdf-sidebar-title {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .pdf-sidebar-header {
                padding: 14px 16px;
            }

            .pdf-sidebar-title {
                font-size: 16px;
                padding-right: 12px;
            }

            .pdf-sidebar-close {
                width: 32px;
                height: 32px;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        function openPdfSidebar(pdfUrl, title) {
            const sidebar = document.getElementById('pdf-sidebar');
            const iframe = document.getElementById('pdf-sidebar-iframe');
            const titleElement = document.getElementById('pdf-sidebar-title');
            
            iframe.src = pdfUrl + '#toolbar=0&navpanes=0&scrollbar=0';
            titleElement.textContent = title;
            sidebar.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePdfSidebar() {
            const sidebar = document.getElementById('pdf-sidebar');
            const iframe = document.getElementById('pdf-sidebar-iframe');
            
            sidebar.classList.remove('active');
            document.body.style.overflow = '';
            
            // Очищаем iframe после закрытия для экономии ресурсов
            setTimeout(() => {
                iframe.src = '';
            }, 300);
        }

        // Закрытие по ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePdfSidebar();
            }
        });
    </script>
    @endpush
@endsection

