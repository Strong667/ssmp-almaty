@extends('frontend.layouts.app')

@section('title', 'Миссия и ценности')

@section('content')
    <!-- Mission Values Section -->
    <section id="mission" class="mission section">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Миссия и ценности</h2>
                <p>Основные принципы и цели медицинского центра</p>
            </header>

            @if($missionValues->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-heart"></i>
                    <p>Информация о миссии и ценностях пока не добавлена</p>
                </div>
            @else
                <div class="row gy-4">
                    @foreach($missionValues as $missionValue)
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="mission-card">
                                <div class="mission-icon">
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div class="mission-content">
                                    <h3 class="mission-title">{{ $missionValue->title }}</h3>
                                    <p class="mission-description">{{ $missionValue->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        /* Mission Values Section */
        .mission {
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

        .mission-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            border-top: 4px solid #1977cc;
        }

        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
            border-top-color: #667eea;
        }

        .mission-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #1977cc 0%, #667eea 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            color: #fff;
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(25, 119, 204, 0.3);
        }

        .mission-card:hover .mission-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 6px 20px rgba(25, 119, 204, 0.4);
        }

        .mission-content {
            flex-grow: 1;
        }

        .mission-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 15px 0;
            color: #2c4964;
            line-height: 1.3;
        }

        .mission-description {
            font-size: 16px;
            line-height: 1.8;
            color: #6c757d;
            margin: 0;
        }

        /* Dark Theme */
        [data-theme="dark"] .mission {
            background: #1e293b;
        }

        [data-theme="dark"] .mission-card {
            background: rgba(30, 41, 59, 0.8);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            border-top-color: #1977cc;
        }

        [data-theme="dark"] .mission-card:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.7);
            border-top-color: #60a5fa;
        }

        [data-theme="dark"] .mission-title {
            color: #e2e8f0;
        }

        [data-theme="dark"] .mission-description {
            color: #b0b0b0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .mission {
                padding: 100px 0 60px;
            }

            .mission-card {
                padding: 30px;
            }

            .mission-icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
                margin-bottom: 20px;
            }

            .mission-title {
                font-size: 20px;
            }

            .mission-description {
                font-size: 15px;
            }
        }
    </style>
    @endpush
@endsection

