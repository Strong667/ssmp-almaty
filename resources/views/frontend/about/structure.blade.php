@extends('frontend.layouts.app')

@section('title', 'Структура')

@section('content')
    <!-- Structure Section -->
    <section id="structure" class="structure section">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Структура</h2>
                <p>Организационная структура медицинского центра</p>
            </header>

            @if($structures->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-diagram-3"></i>
                    <p>Информация о структуре пока не добавлена</p>
                </div>
            @else
                <div class="row gy-4">
                    @foreach($structures as $structure)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="structure-card">
                                @if($structure->image_url)
                                    <div class="structure-image">
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
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        /* Structure Section */
        .structure {
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

        .structure-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .structure-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
        }

        .structure-image {
            width: 100%;
            height: 250px;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .structure-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .structure-card:hover .structure-image img {
            transform: scale(1.1);
        }

        .structure-content {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80px;
        }

        .structure-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            color: #2c4964;
            text-align: center;
            line-height: 1.4;
        }

        /* Dark Theme */
        [data-theme="dark"] .structure {
            background: #1e293b;
        }

        [data-theme="dark"] .structure-card {
            background: rgba(30, 41, 59, 0.8);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .structure-card:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] .structure-title {
            color: #e2e8f0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .structure {
                padding: 100px 0 60px;
            }

            .structure-image {
                height: 200px;
            }

            .structure-content {
                padding: 20px;
            }

            .structure-title {
                font-size: 18px;
            }
        }
    </style>
    @endpush
@endsection

