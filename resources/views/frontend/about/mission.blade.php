@extends('frontend.layouts.app')

@section('title', 'Миссия и ценности')

@section('content')
    <section class="section">
        <div class="container">
            <header class="section-header">
                <h2>Миссия и ценности</h2>
            </header>

            @if($missionValues->isNotEmpty())
                <div class="row gy-4">
                    @foreach($missionValues as $missionValue)
                        <div class="col-lg-6" data-aos="fade-up">
                            <div class="mission-card">
                                <div class="mission-content">
                                    <h3 class="mission-title">{{ $missionValue->title }}</h3>
                                    <div class="mission-description">
                                        {!! $missionValue->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <p>Миссия и ценности пока не добавлены</p>
                </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        .mission-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: 0.3s;
            height: 100%;
            min-height: 200px;
            display: flex;
            flex-direction: column;
        }

        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
        }

        .mission-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 20px 0;
            color: #2c4964;
        }

        .mission-description {
            color: #6c757d;
            line-height: 1.8;
        }

        [data-theme="dark"] .mission-card {
            background: #2a2a2a;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .mission-card:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] .mission-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .mission-description {
            color: #b0b0b0;
        }
    </style>
    @endpush
@endsection
