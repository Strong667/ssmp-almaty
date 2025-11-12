@extends('frontend.layouts.app')

@section('title', 'Этический кодекс')

@section('content')
    <!-- Ethical Code Section -->
    <section id="ethical-code" class="ethical-code section">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Этический кодекс</h2>
                <p>Документы, регламентирующие этические нормы и стандарты медицинского центра</p>
            </header>

            @if($ethicalCodes->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-file-earmark-text"></i>
                    <p>Документы этического кодекса пока не добавлены</p>
                </div>
            @else
                <div class="row gy-4">
                    @foreach($ethicalCodes as $ethicalCode)
                        <div class="col-12" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="ethical-code-card">
                                <div class="ethical-code-header">
                                    <div class="ethical-code-icon">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                    </div>
                                    <div class="ethical-code-content">
                                        <h3 class="ethical-code-title">{{ $ethicalCode->title }}</h3>
                                        @if($ethicalCode->pdf_url)
                                            <div class="ethical-code-actions">
                                                <a href="{{ $ethicalCode->pdf_url }}" target="_blank" class="ethical-code-link">
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                    <span>Открыть в новой вкладке</span>
                                                </a>
                                                <a href="{{ $ethicalCode->pdf_url }}" download class="ethical-code-link ethical-code-link-secondary">
                                                    <i class="bi bi-download"></i>
                                                    <span>Скачать PDF</span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if($ethicalCode->pdf_url)
                                    <div class="ethical-code-preview">
                                        <iframe src="{{ $ethicalCode->pdf_url }}#toolbar=1&navpanes=0&scrollbar=1" 
                                                class="ethical-code-iframe" 
                                                title="{{ $ethicalCode->title }}">
                                            <p>Ваш браузер не поддерживает отображение PDF. 
                                                <a href="{{ $ethicalCode->pdf_url }}" target="_blank">Откройте PDF в новой вкладке</a>.
                                            </p>
                                        </iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        /* Ethical Code Section */
        .ethical-code {
            padding: 120px 0 80px;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 64px;
            color: #1977cc;
            margin-bottom: 20px;
            display: block;
        }

        .empty-state p {
            font-size: 18px;
            margin: 0;
        }

        [data-theme="dark"] .empty-state {
            color: #b0b0b0;
        }

        .ethical-code-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border-top: 4px solid #1977cc;
        }

        .ethical-code-card:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
            border-top-color: #667eea;
        }

        .ethical-code-header {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            align-items: flex-start;
        }

        .ethical-code-icon {
            width: 60px;
            height: 60px;
            min-width: 60px;
            background: linear-gradient(135deg, #1977cc 0%, #667eea 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(25, 119, 204, 0.3);
        }

        .ethical-code-content {
            flex-grow: 1;
        }

        .ethical-code-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 20px 0;
            color: #2c4964;
            line-height: 1.3;
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
            background: linear-gradient(135deg, #1977cc 0%, #667eea 100%);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(25, 119, 204, 0.3);
        }

        .ethical-code-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 119, 204, 0.4);
            color: #fff;
        }

        .ethical-code-link-secondary {
            background: #6c757d;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .ethical-code-link-secondary:hover {
            background: #5a6268;
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        }

        .ethical-code-link i {
            font-size: 16px;
        }

        .ethical-code-preview {
            width: 100%;
            height: 800px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: #f8f9fa;
        }

        .ethical-code-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Dark Theme */
        [data-theme="dark"] .ethical-code {
            background: #1e293b;
        }

        [data-theme="dark"] .ethical-code-card {
            background: rgba(30, 41, 59, 0.8);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            border-top-color: #1977cc;
        }

        [data-theme="dark"] .ethical-code-card:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.7);
            border-top-color: #60a5fa;
        }

        [data-theme="dark"] .ethical-code-title {
            color: #e2e8f0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .ethical-code {
                padding: 100px 0 60px;
            }

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

            .ethical-code-preview {
                height: 500px;
            }
        }
    </style>
    @endpush
@endsection

