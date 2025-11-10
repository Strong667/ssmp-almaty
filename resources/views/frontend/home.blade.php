@extends('frontend.layouts.app')

@section('title', 'Главная')

@section('content')
    <section class="hero">
        @if($data)
            <h1>{{ $data->main_title }}</h1>
            <p>{{ $data->main_description }}</p>

            @if($data->main_image)
                <img src="{{ asset('storage/' . $data->main_image) }}" alt="Главное изображение">
            @endif
        @else
            <h1>Добро пожаловать в Медицинский центр</h1>
            <p>Данные пока не добавлены администратором.</p>
        @endif
    </section>
@endsection
