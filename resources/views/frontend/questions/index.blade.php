@extends('frontend.layouts.app')

@section('title', 'Вопросы и ответы')

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
                    <li class="breadcrumb-item active" aria-current="page">Вопросы и ответы</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Questions Section -->
    <section class="questions section">
        <div class="container">
            <div class="row">
                <!-- Form Section -->
                <div class="col-lg-5">
                    <div class="question-form-card">
                        <h2 class="form-title">Задать вопрос</h2>
                        <p class="form-subtitle">Заполните форму ниже, и мы ответим вам в ближайшее время</p>

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

                        <form action="{{ route('questions.store') }}" method="POST" class="question-form">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person"></i> Ваше имя <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
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
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
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
                                <label for="question" class="form-label">
                                    <i class="bi bi-question-circle"></i> Ваш вопрос <span class="text-danger">*</span>
                                </label>
                                <textarea 
                                    class="form-control @error('question') is-invalid @enderror" 
                                    id="question" 
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
                                        id="notify_email" 
                                        name="notify_email" 
                                        value="1"
                                        {{ old('notify_email') ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="notify_email">
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
                    <div class="qa-list">
                        <h2 class="qa-title">Часто задаваемые вопросы</h2>
                        @if($questions->isNotEmpty())
                            <div class="qa-items">
                                @foreach($questions as $question)
                                    <div class="qa-item">
                                        <div class="qa-question">
                                            <div class="qa-question-header">
                                                <i class="bi bi-question-circle-fill"></i>
                                                <h4>{{ $question->name }}</h4>
                                            </div>
                                            <p>{{ $question->question }}</p>
                                            <div class="qa-date">
                                                <i class="bi bi-calendar"></i>
                                                {{ $question->created_at->format('d.m.Y') }}
                                            </div>
                                        </div>
                                        <div class="qa-answer">
                                            <div class="qa-answer-header">
                                                <i class="bi bi-check-circle-fill"></i>
                                                <h5>Ответ:</h5>
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

        /* Questions Section */
        .questions {
            padding: 40px 0;
            background: #fff;
        }

        /* Form Card */
        .question-form-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            position: sticky;
            top: 20px;
        }

        .form-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .form-subtitle {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .question-form .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            font-size: 14px;
            color: #2c4964;
            margin-bottom: 8px;
            font-family: "Montserrat", sans-serif;
        }

        .form-label i {
            color: #0d9488;
            font-size: 16px;
        }

        .form-control {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
            outline: none;
        }

        .btn-submit {
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

        .btn-submit:hover {
            background: #0f766e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
        }

        .btn-submit i {
            font-size: 18px;
        }

        /* Form Checkbox */
        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            margin: 0;
            cursor: pointer;
            border: 2px solid #dee2e6;
            border-radius: 4px;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .form-check-input:checked {
            background-color: #0d9488;
            border-color: #0d9488;
        }

        .form-check-input:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
            outline: none;
        }

        .form-check-label {
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

        .form-check-label i {
            color: #0d9488;
            font-size: 16px;
        }

        [data-theme="dark"] .form-check-input {
            background-color: #333333;
            border-color: rgba(255, 255, 255, 0.2);
        }

        [data-theme="dark"] .form-check-input:checked {
            background-color: #0d9488;
            border-color: #0d9488;
        }

        [data-theme="dark"] .form-check-label {
            color: #e0e0e0;
        }

        /* Q&A List */
        .qa-list {
            padding-left: 30px;
        }

        .qa-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 30px 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .qa-items {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .qa-item {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 24px;
            transition: all 0.3s ease;
        }

        .qa-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .qa-question {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .qa-question-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .qa-question-header i {
            color: #0d9488;
            font-size: 20px;
        }

        .qa-question-header h4 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .qa-question p {
            color: #495057;
            line-height: 1.6;
            margin: 0 0 12px 0;
            font-size: 14px;
        }

        .qa-date {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #6c757d;
            font-size: 12px;
        }

        .qa-date i {
            font-size: 14px;
        }

        .qa-answer {
            padding-top: 20px;
        }

        .qa-answer-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .qa-answer-header i {
            color: #22c55e;
            font-size: 18px;
        }

        .qa-answer-header h5 {
            font-size: 15px;
            font-weight: 600;
            margin: 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .qa-answer p {
            color: #495057;
            line-height: 1.7;
            margin: 0;
            font-size: 14px;
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

        /* Dark Theme */
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

        [data-theme="dark"] .questions {
            background: #1a1a1a;
        }

        [data-theme="dark"] .question-form-card {
            background: #2a2a2a;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .form-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .form-subtitle {
            color: #adb5bd;
        }

        [data-theme="dark"] .form-label {
            color: #e0e0e0;
        }

        [data-theme="dark"] .form-control {
            background: #333333;
            border-color: rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
        }

        [data-theme="dark"] .form-control:focus {
            border-color: #0d9488;
            background: #3a3a3a;
        }

        [data-theme="dark"] .form-control::placeholder {
            color: #6c757d;
        }

        [data-theme="dark"] .qa-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .qa-item {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .qa-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .qa-question {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .qa-question-header h4 {
            color: #e0e0e0;
        }

        [data-theme="dark"] .qa-question p {
            color: #adb5bd;
        }

        [data-theme="dark"] .qa-date {
            color: #6c757d;
        }

        [data-theme="dark"] .qa-answer-header h5 {
            color: #e0e0e0;
        }

        [data-theme="dark"] .qa-answer p {
            color: #adb5bd;
        }

        [data-theme="dark"] .alert-success {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.4);
            color: #6ee7b7;
        }

        [data-theme="dark"] .alert-danger {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.4);
            color: #fca5a5;
        }

        [data-theme="dark"] .alert-info {
            background: rgba(59, 130, 246, 0.2);
            border-color: rgba(59, 130, 246, 0.4);
            color: #93c5fd;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .qa-list {
                padding-left: 0;
                margin-top: 30px;
            }

            .question-form-card {
                position: static;
            }
        }
    </style>
    @endpush
@endsection

