@extends('layouts.app')

@section('content')
    <main class="main">
        <section class="specialties-hero">
            <div class="container">
                <div class="specialties-hero__panel">
                    <div class="specialties-hero__text">
                        <h1 class="specialties-hero__title">Вопрос-ответ</h1>
                        <p class="specialties-hero__lead">
                            {{ \App\Models\Connection::get('Подзаголовок страницы «Вопрос-ответ»') }}
                        </p>
                    </div>
                    <div class="specialties-hero__badge" aria-hidden="true">
                        <img src="{{asset('media/images/icons/вопрос_ответ.svg')}}" alt="" width="180"
                             height="180">
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section" aria-label="Часто задаваемые вопросы">
            <div class="container">
                <ul class="faq-list" role="list">
                    @foreach ($faqs as $faq)
                        <li class="faq-item">
                            <details class="faq-details">
                                <summary class="faq-summary">
                                    <span class="faq-num">
                                        {{ sprintf('%02d', $loop->iteration) }}
                                    </span>
                                    <span class="faq-question">{{ $faq->question }}</span>
                                    <span class="faq-icon" aria-hidden="true"></span>
                                </summary>
                                <div class="faq-answer">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </details>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </main>
@endsection
