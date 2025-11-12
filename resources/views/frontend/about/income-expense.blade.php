@extends('frontend.layouts.app')

@section('title', 'Отчёты о доходах и расходах')

@section('content')
    <!-- Income Expense Reports Section -->
    <section id="income-expense" class="income-expense section">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Отчёты о доходах и расходах</h2>
                <p>Финансовые отчёты медицинского центра</p>
            </header>

            @if($reports->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-file-earmark-text"></i>
                    <p>Отчёты о доходах и расходах пока не добавлены</p>
                </div>
            @else
                <div class="row gy-4">
                    @foreach($reports as $report)
                        <div class="col-12" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="report-card">
                                <div class="report-header">
                                    <div class="report-icon">
                                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                    </div>
                                    <div class="report-content">
                                        <h3 class="report-title">{{ $report->title }}</h3>
                                        @if($report->description)
                                            <div class="report-description">
                                                {!! $report->description !!}
                                            </div>
                                        @endif
                                        @if($report->file_url)
                                            <div class="report-actions">
                                                <a href="{{ $report->file_url }}" target="_blank" class="report-link">
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                    <span>Открыть в новой вкладке</span>
                                                </a>
                                                <a href="{{ $report->file_url }}" download class="report-link report-link-secondary">
                                                    <i class="bi bi-download"></i>
                                                    <span>Скачать файл</span>
                                                </a>
                                            </div>
                                        @endif
                                        <div class="report-date">
                                            <i class="bi bi-calendar3"></i>
                                            <span>Опубликовано: {{ $report->created_at->format('d.m.Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if($report->file_url && str_ends_with(strtolower($report->file_path), '.pdf'))
                                    <div class="report-preview">
                                        <iframe src="{{ $report->file_url }}#toolbar=1&navpanes=0&scrollbar=1" 
                                                class="report-iframe" 
                                                title="{{ $report->title }}">
                                            <p>Ваш браузер не поддерживает отображение PDF. 
                                                <a href="{{ $report->file_url }}" target="_blank">Откройте PDF в новой вкладке</a>.
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
        /* Income Expense Reports Section */
        .income-expense {
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

        .report-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border-top: 4px solid #1977cc;
        }

        .report-card:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
            border-top-color: #667eea;
        }

        .report-header {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            align-items: flex-start;
        }

        .report-icon {
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

        .report-content {
            flex-grow: 1;
        }

        .report-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 15px 0;
            color: #2c4964;
            line-height: 1.3;
        }

        .report-description {
            font-size: 16px;
            line-height: 1.8;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .report-description p {
            margin-bottom: 10px;
        }

        .report-description p:last-child {
            margin-bottom: 0;
        }

        .report-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .report-link {
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

        .report-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 119, 204, 0.4);
            color: #fff;
        }

        .report-link-secondary {
            background: #6c757d;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .report-link-secondary:hover {
            background: #5a6268;
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        }

        .report-link i {
            font-size: 16px;
        }

        .report-date {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6c757d;
        }

        .report-date i {
            font-size: 16px;
        }

        .report-preview {
            width: 100%;
            height: 800px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: #f8f9fa;
        }

        .report-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Dark Theme */
        [data-theme="dark"] .income-expense {
            background: #1e293b;
        }

        [data-theme="dark"] .report-card {
            background: rgba(30, 41, 59, 0.8);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            border-top-color: #1977cc;
        }

        [data-theme="dark"] .report-card:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.7);
            border-top-color: #60a5fa;
        }

        [data-theme="dark"] .report-title {
            color: #e2e8f0;
        }

        [data-theme="dark"] .report-description {
            color: #b0b0b0;
        }

        [data-theme="dark"] .report-date {
            color: #b0b0b0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .income-expense {
                padding: 100px 0 60px;
            }

            .report-card {
                padding: 20px;
            }

            .report-header {
                flex-direction: column;
                gap: 15px;
            }

            .report-icon {
                width: 50px;
                height: 50px;
                min-width: 50px;
                font-size: 20px;
            }

            .report-title {
                font-size: 20px;
                margin-bottom: 12px;
            }

            .report-description {
                font-size: 15px;
                margin-bottom: 15px;
            }

            .report-actions {
                flex-direction: column;
            }

            .report-link {
                width: 100%;
                justify-content: center;
                padding: 10px 16px;
                font-size: 14px;
            }

            .report-preview {
                height: 500px;
            }
        }
    </style>
    @endpush
@endsection

