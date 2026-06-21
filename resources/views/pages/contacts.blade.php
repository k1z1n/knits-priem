@extends('layouts.app')

@section('content')
    <main class="main">
        <section class="specialties-hero">
            <div class="container">
                <div class="specialties-hero__panel">
                    <div class="specialties-hero__text">
                        <h1 class="specialties-hero__title">Контакты</h1>
                        <p class="specialties-hero__lead">
                            {{ \App\Models\Connection::get('Подзаголовок страницы «Контакты»') }}
                        </p>
                    </div>
                    <div class="specialties-hero__badge" aria-hidden="true">
                        <img src="{{asset('media/images/icons/контакты.svg')}}" alt="" width="180"
                             height="180">
                    </div>
                </div>
            </div>
        </section>
        @foreach($contacts as $contact)
            <section class="contacts-page" aria-label="Контакты приёмной комиссии">
                <div class="container">
                    <ul class="contact-cards" role="list">
                        <li class="contact-card contact-card--address">
                            <div class="contact-card__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 21s-7-7.2-7-12a7 7 0 1 1 14 0c0 4.8-7 12-7 12Z"></path>
                                    <circle cx="12" cy="9" r="2.6"></circle>
                                </svg>
                            </div>
                            <span class="contact-card__eyebrow">Адрес</span>
                            <p class="contact-card__value">{{$contact->address}}</p>
                            <a class="contact-card__link"
                               href="https://yandex.ru/maps/?text=Казань%2C+ул.+Бари+Галеева%2C+3а" target="_blank"
                               rel="noopener">
                                Открыть на карте →
                            </a>
                        </li>

                        <li class="contact-card contact-card--phone">
                            <div class="contact-card__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M21 16.5v2.4a2 2 0 0 1-2.2 2 19.7 19.7 0 0 1-8.6-3 19.4 19.4 0 0 1-6-6A19.7 19.7 0 0 1 1.2 3.3 2 2 0 0 1 3.2 1h2.4a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.6a2 2 0 0 1-.5 2.1l-1 1a16 16 0 0 0 6 6l1-1a2 2 0 0 1 2.1-.5c.8.3 1.7.5 2.6.6a2 2 0 0 1 1.6 2Z">
                                    </path>
                                </svg>
                            </div>
                            <span class="contact-card__eyebrow">Телефоны</span>
                            @if($contact->phone)
                                <p class="contact-card__value">
                                    <a href="tel:+{{ preg_replace('/\D/', '', $contact->phone) }}">{{$contact->formatted_phone}} {{$contact->extension_phone}}</a><br>
                                </p>
                            @endif
                            <a class="contact-card__link" href="tel:+78432035555">
                                Позвонить в комиссию →
                            </a>
                        </li>

                        <li class="contact-card contact-card--mail">
                            <div class="contact-card__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="5" width="18" height="14" rx="2.5"></rect>
                                    <path d="m4 7 8 6 8-6"></path>
                                </svg>
                            </div>
                            <span class="contact-card__eyebrow">Электронная почта</span>
                            <p class="contact-card__value">
                                <a href="mailto:mck.ktits@tatar.ru">{{$contact->email}}</a>
                            </p>
                            <a class="contact-card__link" href="mailto:{{$contact->email}}">
                                Написать письмо →
                            </a>
                        </li>
                    </ul>

                    <div class="contacts-row">
                        <article class="schedule-card">
                            <div class="schedule-card__head">
                                <div class="schedule-card__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path d="M12 7v5l3.2 2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="schedule-card__eyebrow">Режим работы</span>
                                    <h2 class="schedule-card__title">Время работы приёмной комиссии</h2>
                                </div>
                            </div>
                            <ul class="schedule-list" role="list">
                                @foreach($contact->schedule ?? [] as $row)
                                    <li class="schedule-list__item @if(!empty($row['is_off'])) schedule-list__item--off @endif">
                                        <span class="schedule-list__days">{{ $row['days'] }}</span>
                                        <span class="schedule-list__hours">
                                            @if(!empty($row['is_off']))
                                                выходной
                                            @else
                                                {{ \Illuminate\Support\Str::of($row['time_from'])->substr(0, 5) }} — {{ \Illuminate\Support\Str::of($row['time_to'])->substr(0, 5) }}
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                            <p class="schedule-card__note">
                                Приходите заранее — в последние дни приёма у комиссии возможна живая очередь.
                            </p>
                        </article>

                        <aside class="admission-notice admission-notice--page">
                            <div class="admission-notice__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3.5" y="5" width="17" height="15" rx="2.5"></rect>
                                    <path d="M3.5 9.5h17"></path>
                                    <path d="M8 3v4"></path>
                                    <path d="M16 3v4"></path>
                                </svg>
                            </div>
                            <div class="admission-notice__body">
                                <p class="admission-notice__eyebrow">Сроки приёма</p>
                                <h2 class="admission-notice__title">Приёмная комиссия принимает документы</h2>

                                <ul class="admission-notice__dates">
                                    <li>
                                        <span class="admission-notice__tag">Бюджет</span>
                                        <span>
                                            {{ $contact->budget_from->translatedFormat('j F') }} —
                                            {{ $contact->budget_to->translatedFormat('j F') }} включительно
                                        </span>
                                    </li>
                                    <li>
                                        <span class="admission-notice__tag">Внебюджет</span>
                                        <span>
                                            {{ $contact->commerce_from->translatedFormat('j F') }} —
                                            {{ $contact->commerce_to->translatedFormat('j F') }} включительно
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>

                    <section class="map-card" aria-label="Карта">
                        <div class="map-card__head">
                            <p class="map-card__lead">{{$contact->route}}</p>
                        </div>
                        <div class="map-card__frame">
                            <iframe src="https://yandex.ru/map-widget/v1/?text=Казань%2C%20Бари%20Галеева%203а&z=16"
                                    title="Карта — ул. Бари Галеева, 3а, Казань" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </section>
                </div>
            </section>
        @endforeach
    </main>
@endsection
