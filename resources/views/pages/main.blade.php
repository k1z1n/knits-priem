@extends('layouts.app')


@section('content')
    @foreach($contacts as $contact)
        <section class="hero-banner">
            <img src="{{asset('media/images/ktits3.png')}}" alt="" class="hero-banner__photo">
            <div class="hero-banner__panel"></div>
            <div class="container hero-banner__inner">
                <div class="hero-banner__content">
                    <div class="hero-banner__contacts">
                        <a href="tel:{{ preg_replace('/\D/', '', $contact->phone) }}" class="hero-banner__contact">
                            <img src="{{asset('media/images/icons/phone.svg')}}" alt=""
                                 class="hero-banner__contact-icon">
                            {{ $contact->formatted_phone }}@if($contact->extension_phone)
                                {{ $contact->extension_phone }}
                            @endif
                        </a>
                        <a href="mailto:{{$contact->email}}" class="hero-banner__contact">
                            <img src="{{asset('media/images/icons/email.svg')}}" alt=""
                                 class="hero-banner__contact-icon">
                            {{$contact->email}}
                        </a>
                    </div>
                    <div class="hero-banner__brand">
                        <img src="{{asset('media/images/logo/white.svg')}}" alt="Логотип МЦК-КТИТС"
                             class="hero-banner__logo">
                    </div>
                    <div class="hero-banner__text">
                        <h1 class="hero-banner__title">{{ \App\Models\Connection::get('Заголовок баннера') }}</h1>
                        <p class="hero-banner__eyebrow">{{ \App\Models\Connection::get('Подзаголовок баннера') }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="quick-links-section">
            <div class="container">
                <div class="quick-links">
                    <div class="quick-links__grid">
                        <a class="quick-link-card" href="{{route('view.specialities')}}">
                            <span class="quick-link-card__text">Специальности</span>
                            <span class="quick-link-card__icon">
                            <img src="{{asset('media/images/icons/иконка%20перехода.svg')}}" alt="" width="20"
                                 height="20">
                        </span>
                        </a>
                        <a class="quick-link-card" href="{{route('view.numbers')}}">
                            <span class="quick-link-card__text">Контрольные цифры приема</span>
                            <span class="quick-link-card__icon">
                            <img src="{{asset('media/images/icons/иконка%20перехода.svg')}}" alt="" width="20"
                                 height="20">
                        </span>
                        </a>
                        <a class="quick-link-card" href="{{route('view.rating')}}">
                            <span class="quick-link-card__text">Рейтинг абитуриентов</span>
                            <span class="quick-link-card__icon">
                            <img src="{{asset('media/images/icons/иконка%20перехода.svg')}}" alt="" width="20"
                                 height="20">
                        </span>
                        </a>
                        <a class="quick-link-card" href="{{route('view.faq')}}">
                            <span class="quick-link-card__text">Часто задаваемые вопросы</span>
                            <span class="quick-link-card__icon">
                            <img src="{{asset('media/images/icons/иконка%20перехода.svg')}}" alt="" width="20"
                                 height="20">
                        </span>
                        </a>
                        <a class="quick-link-card" href="{{route('view.documents')}}">
                            <span class="quick-link-card__text">Нормативные документы</span>
                            <span class="quick-link-card__icon">
                            <img src="{{asset('media/images/icons/иконка%20перехода.svg')}}" alt="" width="20"
                                 height="20">
                        </span>
                        </a>
                        <a class="quick-link-card" href="{{route('view.contacts')}}">
                            <span class="quick-link-card__text">Контакты приемной комиссии</span>
                            <span class="quick-link-card__icon">
                            <img src="{{asset('media/images/icons/иконка%20перехода.svg')}}" alt="" width="20"
                                 height="20">
                        </span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="admission-steps">
            <div class="container">
                <div class="admission-steps__panel" id="podachazayavleni">
                    <div class="admission-steps__head">
                        <h2 class="admission-steps__title">Порядок действий для поступления</h2>
                    </div>
                    <aside class="admission-notice">
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
                            <h3 class="admission-notice__title">Приёмная комиссия принимает документы</h3>
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
                    <ol class="admission-flow">
                        <li class="admission-flow__item" style="--i:1">
                            <div class="admission-flow__marker" aria-hidden="true">
                                <span class="admission-flow__num">1</span>
                                <span class="admission-flow__ring"></span>
                            </div>
                            <article class="admission-flow__card">
                                <span class="admission-flow__eyebrow">Папка поступающего</span>
                                <h3>Подготовьте документы</h3>
                                <ul class="admission-flow__checklist">
                                    @foreach($admissionDocuments as $adDocument)
                                        <li>{{$adDocument->title}} <em>{{$adDocument->note}}</em></li>
                                    @endforeach
                                </ul>
                            </article>
                        </li>
                        <li class="admission-flow__item" style="--i:2">
                            <div class="admission-flow__marker" aria-hidden="true">
                                <span class="admission-flow__num">2</span>
                                <span class="admission-flow__ring"></span>
                            </div>
                            <article class="admission-flow__card">
                                <span class="admission-flow__eyebrow">Онлайн-анкета</span>
                                <h3>Заполните электронное заявление в личном кабинете</h3>
                                <p>
                                    Чем подробнее анкета — тем короче визит в техникум. Всё заполненное заранее
                                    экономит время при регистрации заявления.
                                </p>
                                <div class="admission-flow__actions">
                                    <a href="https://webc.mck-ktits.ru/college1c/ru/?N=abiturlk&P=qawsed" class="admission-flow__btn">Личный кабинет →</a>
                                </div>
                            </article>
                        </li>
                        <li class="admission-flow__item" style="--i:3">
                            <div class="admission-flow__marker" aria-hidden="true">
                                <span class="admission-flow__num">3</span>
                                <span class="admission-flow__ring"></span>
                            </div>
                            <article class="admission-flow__card">
                                <span class="admission-flow__eyebrow">Запись на приём</span>
                                <h3>Выберите удобное время визита</h3>
                                <p>
                                    Запись — на одно заявление; сопровождающих учитывать не нужно. При желании
                                    можно прийти в порядке живой очереди.
                                </p>
				<iframe src="https://rubitime.ru/api/get-project/ea4e5c3178914c2818a0be78171f156d9411bc0ef69958c220792549e87a98fa?rvtype=iframe" id="rubitime-project__iframe-static" style="width: 100%; height: 660px; min-height: 660px; border: 0px;"></iframe>
<script>
                                    /* Авто-ресайз iframe Rubitime: слушаем сообщения о высоте
                                       и подгоняем высоту, чтобы поля формы (появляются после
                                       выбора даты) не обрезались под блоком ниже. */
                                    (function () {
                                        var IFRAME_ID = 'rubitime-project__iframe-static';
                                        window.addEventListener('message', function (e) {
                                            if (typeof e.data !== 'string' || e.data.indexOf('height') === -1) return;
                                            var data;
                                            try { data = JSON.parse(e.data); } catch (err) { return; }
                                            if (!data || data.type !== 'static' || !data.height) return;
                                            var iframe = document.getElementById(IFRAME_ID);
                                            if (iframe) iframe.style.height = (Math.round(data.height) + 20) + 'px';
                                        }, false);
                                    })();
                                </script>
                                <aside class="admission-flow__note">
                                    Заполните личный кабинет дома, в спокойной обстановке — это повысит точность
                                    данных и ускорит визит.
                                </aside>
                            </article>
                        </li>
                        <li class="admission-flow__item admission-flow__item--finish" style="--i:4">
                            <div class="admission-flow__marker admission-flow__marker--finish" aria-hidden="true">
                                <span class="admission-flow__num">4</span>
                                <span class="admission-flow__ring"></span>
                            </div>
                            <article class="admission-flow__card">
                                <span class="admission-flow__eyebrow">Финиш</span>
                                <h3>Приходите в техникум в выбранное время</h3>
                                <p>
                                    Опоздали или сложно планировать? Воспользуйтесь электронной очередью
                                    прямо на месте — или подайте заявление онлайн.
                                </p>
<a href="instr.pdf" target="_blank" class="admission-flow__btn admission-flow__btn--inline">
    Подать через Госуслуги →
</a>
                            </article>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
    @endforeach

    @if($dressCodeItems->isNotEmpty())
        @php
            $dressGroups = [
                \App\Models\DressCodeItem::GROUP_MALE => [
                    'eyebrow' => 'Для юношей',
                    'icon' => '<path d="M8 3.5 12 7l4-3.5"></path><path d="M4 21V9l4-3 4 4 4-4 4 3v12"></path><path d="M10 21v-6h4v6"></path>',
                ],
                \App\Models\DressCodeItem::GROUP_FEMALE => [
                    'eyebrow' => 'Для девушек',
                    'icon' => '<path d="M12 3a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"></path><path d="M9 10h6l3 5-3 1-1 5h-4l-1-5-3-1 3-5z"></path>',
                ],
            ];
        @endphp

       <section class="dresscode-image">
        <div class="container">
            <img src="{{ asset('media/images/dress-code.png') }}" alt="Требования к внешнему виду и одежде обучающихся МЦК-КТИТС" class="dresscode-image__picture">
        </div>
    </section> 
    @endif

    <button type="button" class="scroll-top" aria-label="Наверх">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"
             stroke-linejoin="round">
            <path d="M6 15l6-6 6 6"></path>
        </svg>
    </button>

@endsection
