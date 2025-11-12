@if($news->isNotEmpty())
    <div class="news-section">
        <header class="section-header">
            <h2>НОВОСТИ</h2>
            <p>Актуальные события и новости медицинского центра</p>
        </header>

        <div class="row gy-4">
            @foreach($news as $article)
                <div class="col-lg-4 col-md-6">
                    <div class="news-box">
                        @if($article->image_url)
                            <div class="news-img">
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="img-fluid">
                            </div>
                        @endif
                        <div class="news-content">
                            <h3 class="news-title">{{ $article->title }}</h3>
                            <p class="news-date">{{ $article->display_date }}</p>
                            @if($article->description)
                                <div class="news-description">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($article->description), 150) !!}
                                </div>
                            @endif
                            <a href="#" class="read-more">
                                <span>Читать Новость</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <p>Новостей пока нет.</p>
@endif

<style>
    .news-section {
        margin-top: 2rem;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .section-header h2 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #2c4964;
    }
    
    .section-header p {
        color: #6c757d;
        font-size: 1.1rem;
    }
    
    .news-box {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .news-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }
    
    .news-img {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }
    
    .news-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .news-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .news-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #2c4964;
        line-height: 1.4;
    }
    
    .news-date {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    
    .news-description {
        color: #495057;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        flex-grow: 1;
    }
    
    .read-more {
        display: inline-flex;
        align-items: center;
        color: #1977cc;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
        margin-top: auto;
    }
    
    .read-more:hover {
        color: #155a9e;
    }
    
    .read-more i {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }
    
    .read-more:hover i {
        transform: translateX(5px);
    }
    
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }
    
    .col-lg-4, .col-md-6 {
        padding: 0 15px;
        margin-bottom: 2rem;
    }
    
    @media (min-width: 992px) {
        .col-lg-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
    }
    
    @media (min-width: 768px) and (max-width: 991px) {
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
    
    @media (max-width: 767px) {
        .col-lg-4, .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

