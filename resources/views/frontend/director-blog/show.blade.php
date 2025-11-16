@extends('frontend.layouts.app')

@section('title', 'Блог о директоре')

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
                    <li class="breadcrumb-item active" aria-current="page">Блог о директоре</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Director Blog Section -->
    <section class="director-blog section">
        <div class="container">

            @if($director)
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="director-photo-wrapper">
                            @if($director->photo_url)
                                <img src="{{ $director->photo_url }}" alt="{{ $director->full_name }}" class="director-photo img-fluid">
                            @else
                                <div class="director-photo-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="director-info">
                            <h2 class="director-name">{{ $director->full_name }}</h2>
                            
                            @if($director->birth_date)
                                <div class="director-detail">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>Дата рождения: {{ $director->birth_date->format('d.m.Y') }}</span>
                                </div>
                            @endif

                            @if($director->personal_info)
                                <div class="director-section">
                                    <h3 class="section-title">Личная информация</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($director->personal_info)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($director->education)
                                <div class="director-section">
                                    <h3 class="section-title">Образования</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($director->education)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($director->career)
                                <div class="director-section">
                                    <h3 class="section-title">Карьера</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($director->career)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($director->associate_professor_ram)
                                <div class="director-section">
                                    <h3 class="section-title">Ассоциированный профессор РАМ</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($director->associate_professor_ram)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Информация о директоре пока не добавлена</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Questions to Director Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class="section-title mb-4">Вопросы к директору</h2>
                </div>
            </div>

            <div class="row">
                <!-- Form Section -->
                <div class="col-lg-5">
                    <div class="director-question-form-card">
                        <h2 class="form-title">Задать вопрос директору</h2>
                        <p class="form-subtitle">Заполните форму ниже, и директор ответит вам в ближайшее время</p>

                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('director-blog.store-question') }}" method="POST" class="director-question-form">
                            @csrf
                            <div class="form-group">
                                <label for="director_question_name" class="form-label">
                                    <i class="bi bi-person"></i> Ваше имя <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="director_question_name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required
                                    placeholder="Введите ваше имя"
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="director_question_email" class="form-label">
                                    <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="director_question_email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required
                                    placeholder="example@mail.com"
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="director_question_text" class="form-label">
                                    <i class="bi bi-question-circle"></i> Ваш вопрос <span class="text-danger">*</span>
                                </label>
                                <textarea 
                                    class="form-control @error('question') is-invalid @enderror" 
                                    id="director_question_text" 
                                    name="question" 
                                    rows="6" 
                                    required
                                    placeholder="Опишите ваш вопрос подробно..."
                                >{{ old('question') }}</textarea>
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="director_question_notify" 
                                        name="notify_email" 
                                        value="1"
                                        {{ old('notify_email') ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="director_question_notify">
                                        <i class="bi bi-bell"></i> Получить уведомление на email
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send"></i>
                                Отправить вопрос
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Q&A List Section -->
                <div class="col-lg-7">
                    <div class="director-qa-list">
                        <h2 class="qa-title">Вопросы и ответы</h2>
                        @if($questions->isNotEmpty())
                            <div class="director-qa-items">
                                @foreach($questions as $question)
                                    <div class="director-qa-item">
                                        <div class="director-qa-question">
                                            <div class="director-qa-question-header">
                                                <i class="bi bi-question-circle-fill"></i>
                                                <h4>{{ $question->name }}</h4>
                                            </div>
                                            <p>{{ $question->question }}</p>
                                            <div class="director-qa-date">
                                                <i class="bi bi-calendar"></i>
                                                {{ $question->created_at->format('d.m.Y') }}
                                            </div>
                                        </div>
                                        <div class="director-qa-answer">
                                            <div class="director-qa-answer-header">
                                                <i class="bi bi-check-circle-fill"></i>
                                                <h5>Ответ директора:</h5>
                                            </div>
                                            <p>{{ $question->answer }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                <p class="mb-0">Пока нет опубликованных вопросов и ответов</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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

        /* Director Blog Section */
        .director-blog {
            padding: 40px 0;
            background: #fff;
        }

        .director-photo-wrapper {
            margin-bottom: 30px;
        }

        .director-photo {
            width: 100%;
            border-radius: 8px;
        }

        .director-photo-placeholder {
            width: 100%;
            aspect-ratio: 3/4;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #adb5bd;
            font-size: 120px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .director-info {
            padding: 0;
        }

        .director-name {
            font-size: 28px;
            font-weight: 700;
            color: #212529;
            margin: 0 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        .director-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .director-detail i {
            color: #0d9488;
            font-size: 18px;
        }

        .director-section {
            margin-bottom: 25px;
        }

        .director-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 12px 0;
            font-family: "Montserrat", sans-serif;
        }

        .section-content {
            font-size: 15px;
            color: #495057;
            line-height: 1.7;
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

        [data-theme="dark"] .director-blog {
            background: #1a1a1a;
        }

        [data-theme="dark"] .director-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-detail {
            color: #adb5bd;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .section-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .section-content {
            color: #adb5bd;
        }

        [data-theme="dark"] .director-photo-placeholder {
            background: #2a2a2a;
            border-color: rgba(255, 255, 255, 0.1);
            color: #495057;
        }

        /* Director Questions Section - Same styles as regular questions */
        .director-question-form-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            position: sticky;
            top: 20px;
        }

        .director-question-form-card .form-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .director-question-form-card .form-subtitle {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .director-question-form .form-group {
            margin-bottom: 20px;
        }

        .director-question-form .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            font-size: 14px;
            color: #2c4964;
            margin-bottom: 8px;
            font-family: "Montserrat", sans-serif;
        }

        .director-question-form .form-label i {
            color: #0d9488;
            font-size: 16px;
        }

        .director-question-form .form-control {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .director-question-form .form-control:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
            outline: none;
        }

        .director-question-form .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
        }

        .director-question-form .form-check-input {
            width: 20px;
            height: 20px;
            margin: 0;
            cursor: pointer;
            border: 2px solid #dee2e6;
            border-radius: 4px;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .director-question-form .form-check-input:checked {
            background-color: #0d9488;
            border-color: #0d9488;
        }

        .director-question-form .form-check-input:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
            outline: none;
        }

        .director-question-form .form-check-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #2c4964;
            cursor: pointer;
            font-family: "Montserrat", sans-serif;
            margin: 0;
        }

        .director-question-form .form-check-label i {
            color: #0d9488;
            font-size: 16px;
        }

        .director-question-form .btn-submit {
            width: 100%;
            background: #0d9488;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 14px 24px;
            font-weight: 600;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-family: "Montserrat", sans-serif;
        }

        .director-question-form .btn-submit:hover {
            background: #0f766e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
        }

        .director-question-form .btn-submit i {
            font-size: 18px;
        }

        /* Director Q&A List - Same styles as regular Q&A */
        .director-qa-list {
            padding-left: 30px;
        }

        .director-qa-list .qa-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 30px 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .director-qa-items {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .director-qa-item {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 24px;
            transition: all 0.3s ease;
        }

        .director-qa-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .director-qa-question {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .director-qa-question-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .director-qa-question-header i {
            color: #0d9488;
            font-size: 20px;
        }

        .director-qa-question-header h4 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .director-qa-question p {
            color: #495057;
            line-height: 1.6;
            margin: 0 0 12px 0;
            font-size: 14px;
        }

        .director-qa-date {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #6c757d;
            font-size: 12px;
        }

        .director-qa-date i {
            font-size: 14px;
        }

        .director-qa-answer {
            padding-top: 20px;
        }

        .director-qa-answer-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .director-qa-answer-header i {
            color: #22c55e;
            font-size: 18px;
        }

        .director-qa-answer-header h5 {
            font-size: 15px;
            font-weight: 600;
            margin: 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .director-qa-answer p {
            color: #495057;
            line-height: 1.7;
            margin: 0;
            font-size: 14px;
        }

        [data-theme="dark"] .director-question-form-card {
            background: #2a2a2a;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .director-question-form .form-label {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-question-form .form-control {
            background: #333333;
            border-color: rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-question-form .form-control:focus {
            border-color: #0d9488;
            background: #3a3a3a;
        }

        [data-theme="dark"] .director-question-form .form-control::placeholder {
            color: #6c757d;
        }

        [data-theme="dark"] .director-question-form .form-check-input {
            background-color: #333333;
            border-color: rgba(255, 255, 255, 0.2);
        }

        [data-theme="dark"] .director-question-form .form-check-input:checked {
            background-color: #0d9488;
            border-color: #0d9488;
        }

        [data-theme="dark"] .director-question-form .form-check-label {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-qa-list {
            padding-left: 0;
        }

        [data-theme="dark"] .director-qa-item {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .director-qa-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .director-qa-question {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .director-qa-question-header h4 {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-qa-question p {
            color: #adb5bd;
        }

        [data-theme="dark"] .director-qa-date {
            color: #6c757d;
        }

        [data-theme="dark"] .director-qa-answer-header h5 {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-qa-answer p {
            color: #adb5bd;
        }

        [data-theme="dark"] .director-question-form-card .form-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-question-form-card .form-subtitle {
            color: #adb5bd;
        }

        [data-theme="dark"] .director-qa-list .qa-title {
            color: #e0e0e0;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .alert-info {
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            color: #004085;
        }

        .alert i {
            font-size: 20px;
            flex-shrink: 0;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        [data-theme="dark"] .alert-success {
            background: #064e3b;
            border-color: #047857;
            color: #d1fae5;
        }

        [data-theme="dark"] .alert-danger {
            background: #7f1d1d;
            border-color: #991b1b;
            color: #fee2e2;
        }

        [data-theme="dark"] .alert-info {
            background: #1e3a5f;
            border-color: #1e40af;
            color: #dbeafe;
        }

        @media (max-width: 991px) {
            .director-name {
                font-size: 24px;
            }

            .director-photo-wrapper {
                margin-bottom: 25px;
            }

            .director-qa-list {
                padding-left: 0;
                margin-top: 30px;
            }

            .director-question-form-card {
                position: static;
            }
        }
    </style>
    @endpush
@endsection

