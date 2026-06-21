@extends('layouts.app')

@section('content')
    <main class="main">
        <section class="specialties-hero">
            <div class="container">
                <div class="specialties-hero__panel">
                    <div class="specialties-hero__text">
                        <h1 class="specialties-hero__title">Нормативные документы</h1>
                        <p class="specialties-hero__lead">
                            {{ \App\Models\Connection::get('Подзаголовок страницы «Нормативные документы»') }}
                        </p>
                    </div>
                    <div class="specialties-hero__badge" aria-hidden="true">
                        <img src="{{asset('media/images/icons/документы.svg')}}" alt="" width="180" height="180">
                    </div>
                </div>
            </div>
        </section>

        <section class="docs-section" aria-label="Список нормативных документов">
            <div class="container">
                <ul class="docs-grid" role="list">
                    @foreach($documents as $document)
                    <li class="doc-card">
                        <div class="doc-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 4h20l12 12v24a4 4 0 0 1-4 4H10a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4Z" fill="currentColor"
                                      opacity=".12" />
                                <path d="M30 4v10a4 4 0 0 0 4 4h8" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                <path d="M10 4h20l12 12v24a4 4 0 0 1-4 4H10a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4Z" stroke="currentColor"
                                      stroke-width="2" stroke-linejoin="round" />
                                <text x="24" y="36" text-anchor="middle" font-family="Arial, sans-serif" font-size="10"
                                      font-weight="800" fill="currentColor">PDF</text>
                            </svg>
                        </div>
                        <h3 class="doc-card__title">{{$document->title}}</h3>
                        <a href="{{asset('storage/' . $document->path)}}" class="doc-card__btn" target="_blank"
                           rel="noopener">
                            <span>Посмотреть документ</span>
                            <span class="doc-card__btn-arrow" aria-hidden="true">→</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>

    </main>
@endsection
