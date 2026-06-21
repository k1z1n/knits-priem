@extends('layouts.app')

@section('content')
    <main class="main">
        <section class="specialties-hero">
            <div class="container">
                <div class="specialties-hero__panel">
                    <div class="specialties-hero__text">
                        <h1 class="specialties-hero__title">Специальности</h1>
                        <p class="specialties-hero__lead">
                            {{ \App\Models\Connection::get('Подзаголовок страницы «Специальности»') }}
                        </p>
                    </div>
                    <div class="specialties-hero__badge" aria-hidden="true">
                        <img src="{{asset('media/images/icons/современные_специальности.svg')}}" alt="" width="180" height="180">
                    </div>
                </div>
            </div>
        </section>
        <section class="specialties-section" aria-label="Список специальностей">
            <div class="container">
                <div class="specialties-grid">
                    @php($duplicateTitles = $specialities->countBy('title')->filter(fn ($count) => $count > 1)->keys())
                    @foreach($specialities as $speciality)
                    <article class="spec-card" data-category="it">
                        <span class="spec-card__watermark" aria-hidden="true"></span>
                        <div class="spec-card__top">
                            <div class="spec-card__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                            </div>
                            <div class="spec-card__codebox">
                                <span class="spec-card__codelabel">Код специальности</span>
                                <span class="spec-card__code">{{$speciality->code}}</span>
                            </div>
                        </div>
                        <h2 class="spec-card__title">{{$speciality->title}}</h2>
                        @if($duplicateTitles->contains($speciality->title) && $speciality->qualification)
                            <p class="spec-card__title spec-card__title--qualification">{{ $speciality->qualification }}</p>
                        @endif
                        <ul class="spec-card__meta">
                            <li class="spec-chip spec-chip--time"><span class="spec-chip__label">Срок</span><span class="spec-chip__value">{{$speciality->duration}}</span></li>
                            <li class="spec-chip spec-chip--level"><span class="spec-chip__label">На базе</span><span class="spec-chip__value">9 классов</span></li>
                            <li class="spec-chip spec-chip--form"><span class="spec-chip__label">Форма</span><span class="spec-chip__value">{{$speciality->study_form_label}}</span></li>
                        </ul>
                        <a href="{{route('view.speciality', $speciality->id)}}" class="spec-card__link">
                            <span>Подробнее</span>
                            <span class="spec-card__arrow" aria-hidden="true">→</span>
                        </a>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
