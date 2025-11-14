@extends('frontend.layouts.app')

@section('title', 'Структура')

@section('content')
    <section class="section">
        <div class="container">
            <header class="section-header">
                <h2>Структура</h2>
            </header>

            @if($structures->isNotEmpty())
                <div class="row gy-4">
                    @foreach($structures as $structure)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up">
                            <div class="structure-card">
                                @if($structure->image_url)
                                    <div class="structure-img">
                                        <img src="{{ $structure->image_url }}" alt="{{ $structure->title }}" class="img-fluid">
                                    </div>
                                @endif
                                <div class="structure-content">
                                    <h3 class="structure-title">{{ $structure->title }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <p>Структура пока не добавлена</p>
                </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        .structure-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .structure-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
        }

        .structure-img {
            overflow: hidden;
            height: 250px;
        }

        .structure-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .structure-card:hover .structure-img img {
            transform: scale(1.1);
        }

        .structure-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .structure-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            color: #2c4964;
        }

        [data-theme="dark"] .structure-card {
            background: #2a2a2a;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .structure-card:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] .structure-title {
            color: #e0e0e0;
        }
    </style>
    @endpush
@endsection
