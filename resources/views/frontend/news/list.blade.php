@extends('frontend.layouts.app')

@section('title', 'Новости')

@section('content')
    <section class="section">
        <div class="container">
            <header class="section-header">
                <h2>Новости</h2>
            </header>

            @if($news->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Дата добавления</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('news.detail', $item->slug) }}" style="color: #1977cc; text-decoration: none;">
                                            {{ $item->title }}
                                        </a>
                                    </td>
                                    <td>{{ $item->display_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <p>Новостей пока нет</p>
                </div>
            @endif
        </div>
    </section>
@endsection

