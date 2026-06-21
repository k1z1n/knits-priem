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
                        {{-- <a class="quick-link-card" href="{{route('view.rating')}}">
                            <span class="quick-link-card__text">Рейтинг абитуриентов</span>
                            <span class="quick-link-card__icon">
                            <img src="{{asset('media/images/icons/иконка%20перехода.svg')}}" alt="" width="20"
                                 height="20">
                        </span>
                        </a>--}}
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
				<iframe src="https://rubitime.ru/api/get-project/ea4e5c3178914c2818a0be78171f156d9411bc0ef69958c220792549e87a98fa?rvtype=iframe&amp;noscroll=1" id="rubitime-project__iframe-static" style="width: 100%; height: 660px; border: 0px;"></iframe>
<script>(function() {if (typeof(rubitimeIframeIsLoaded) != "boolean") { var rpis = document.getElementsByClassName("rubitime-project-iframe")[0];var rpisi = document.createElement("iframe");rpisi.src = rpis.getAttribute("href");rpisi.src = rpisi.src.indexOf("?") >= 0 ? rpisi.src+"&rvtype=iframe&noscroll=1" : rpisi.src+"?rvtype=iframe&noscroll=1";rpisi.style.width="100%";rpisi.style.height="660px";rpisi.style.border="0";rpisi.id = 'rubitime-project__iframe-static';rpis.parentNode.replaceChild(rpisi, rpis); var rubiEventMethod=window.addEventListener?"addEventListener":"attachEvent",rubiEventer=window[rubiEventMethod],rubiMessageEvent="attachEvent"==rubiEventMethod?"onmessage":"message";rubiEventer(rubiMessageEvent,function(e){if(e.data!=undefined && typeof(e.data)=="string" -1!=e.data.indexOf("height")){var t=JSON.parse(e.data);if(0!=t.height&&"static"==t.type){var i=document.getElementById("rubitime-project__iframe-static");i&&(i.style.height=Math.round(t.height)+20+"px")} if (t.type == "loadpage" && t.scroll == "yes" && (document.getElementById("rubitime-project-shadow") == null || document.getElementById("rubitime-project-shadow").style.display == "none")) {if (typeof(jQuery) != "undefined") {jQuery("html, body").animate({ scrollTop: $("#rubitime-project__iframe-static").offset().top});} else {document.getElementById("rubitime-project__iframe-static").scrollIntoView()}} }},!1);} var rubitimeEls = document.getElementsByClassName("rubitime-project-iframe"); var ri = 0; while(rubitimeEls.length > ri){rubitimeEls[ri].style.display = "none"; ri++;} })(); var rubitimeIframeIsLoaded = true;</script>
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

    @if($modals->isNotEmpty())
        @foreach($modals as $modal)
            <div class="site-modal" data-delay="{{ $modal->delay_seconds }}" role="dialog" aria-modal="true"
                 aria-labelledby="site-modal-title-{{ $modal->id }}" hidden>
                <div class="site-modal__backdrop" data-modal-close></div>
                <div class="site-modal__dialog" role="document">
                    <button type="button" class="site-modal__close" aria-label="Закрыть" data-modal-close>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M6 6l12 12"></path>
                            <path d="M18 6L6 18"></path>
                        </svg>
                    </button>
                    <div class="site-modal__head">
                        <div class="site-modal__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 9v4"></path>
                                <path d="M12 17h.01"></path>
                                <path d="M10.3 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.7 3.86a2 2 0 0 0-3.4 0z"></path>
                            </svg>
                        </div>
                        <span class="site-modal__eyebrow">Уведомление</span>
                        <h3 id="site-modal-title-{{ $modal->id }}" class="site-modal__title">{{ $modal->title }}</h3>
                    </div>
                    <div class="site-modal__body">{!! nl2br($modal->renderDescription($contacts->first())) !!}</div>
                </div>
            </div>
        @endforeach

        <style>
            .site-modal {
                position: fixed;
                inset: 0;
                z-index: 1000;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                font-family: 'Montserrat', sans-serif;
            }
            .site-modal[hidden] { display: none; }

            .site-modal__backdrop {
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at 50% 40%, rgba(3, 68, 194, 0.35), rgba(15, 23, 42, 0.65));
                backdrop-filter: blur(6px);
                -webkit-backdrop-filter: blur(6px);
                animation: site-modal-fade .35s ease-out;
            }

            .site-modal__dialog {
                position: relative;
                z-index: 1;
                width: 100%;
                max-width: 540px;
                background: #ffffff;
                border-radius: 22px;
                box-shadow: 0 30px 70px rgba(3, 68, 194, 0.32);
                overflow: hidden;
                animation: site-modal-in .4s cubic-bezier(.2, .8, .25, 1);
            }

            @keyframes site-modal-ring { to { transform: rotate(360deg); } }
            @keyframes site-modal-fade { from { opacity: 0; } to { opacity: 1; } }
            @keyframes site-modal-in {
                from { opacity: 0; transform: translateY(20px) scale(.96); }
                to { opacity: 1; transform: none; }
            }

            .site-modal__close {
                position: absolute;
                top: 14px;
                right: 14px;
                width: 36px;
                height: 36px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border: 1px solid rgba(255, 255, 255, 0.35);
                background: rgba(255, 255, 255, 0.18);
                color: #ffffff;
                border-radius: 50%;
                cursor: pointer;
                z-index: 2;
                backdrop-filter: blur(6px);
                transition: background .25s ease, transform .25s ease;
            }
            .site-modal__close:hover { background: rgba(255, 255, 255, 0.32); transform: rotate(90deg); }
            .site-modal__close svg { width: 16px; height: 16px; }

            .site-modal__head {
                position: relative;
                padding: 28px 34px 26px;
                color: #ffffff;
                text-align: left;
                background: linear-gradient(135deg, #0344C2, #3a6ef5);
                background-image:
                    radial-gradient(circle at 85% 20%, rgba(255, 255, 255, 0.18), transparent 55%),
                    radial-gradient(circle at 10% 110%, rgba(255, 255, 255, 0.12), transparent 60%),
                    linear-gradient(135deg, #0344C2, #3a6ef5);
                overflow: hidden;
            }

            .site-modal__head::after {
                content: "";
                position: absolute;
                right: -70px;
                top: -70px;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                border: 1px dashed rgba(255, 255, 255, 0.35);
                animation: site-modal-ring 26s linear infinite;
                pointer-events: none;
            }

            .site-modal__icon {
                position: relative;
                z-index: 1;
                width: 60px;
                height: 60px;
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.18);
                border: 1px solid rgba(255, 255, 255, 0.35);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #ffffff;
                margin-bottom: 18px;
                backdrop-filter: blur(6px);
                animation: site-modal-bob 3.6s ease-in-out infinite;
            }
            .site-modal__icon svg { width: 30px; height: 30px; }

            @keyframes site-modal-bob {
                0%, 100% { transform: translateY(0); }
                50%      { transform: translateY(-4px); }
            }

            .site-modal__eyebrow {
                position: relative;
                z-index: 1;
                display: block;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.24em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, 0.78);
                margin-bottom: 6px;
            }

            .site-modal__title {
                position: relative;
                z-index: 1;
                margin: 0;
                font-size: clamp(20px, 2.2vw, 24px);
                font-weight: 700;
                line-height: 1.3;
                color: #ffffff;
                padding-right: 48px;
                word-wrap: break-word;
                overflow-wrap: break-word;
            }

            .site-modal__body {
                position: relative;
                color: #334155;
                font-size: 16px;
                line-height: 1.6;
                padding: 26px 34px 30px;
                max-height: 50vh;
                overflow-y: auto;
            }

            .site-modal__body::-webkit-scrollbar { width: 6px; }
            .site-modal__body::-webkit-scrollbar-thumb {
                background: rgba(3, 68, 194, 0.25);
                border-radius: 3px;
            }

            .site-modal__count {
                display: inline-block;
                padding: 2px 10px;
                margin: 0 2px;
                border-radius: 8px;
                background: linear-gradient(135deg, var(--accent-color, #0344C2), #3a6ef5);
                color: #ffffff;
                font-weight: 800;
                font-size: 1.15em;
                letter-spacing: -0.01em;
                line-height: 1.35;
                box-shadow: 0 6px 14px rgba(3, 68, 194, 0.28);
                white-space: nowrap;
            }

            .site-modal__word {
                color: var(--accent-color, #0344C2);
                font-weight: 700;
            }

            @media (max-width: 560px) {
                .site-modal { padding: 14px; }
                .site-modal__dialog { border-radius: 18px; }
                .site-modal__head { padding: 22px 22px 22px; }
                .site-modal__body { padding: 22px; }
                .site-modal__icon { width: 52px; height: 52px; margin-bottom: 14px; }
                .site-modal__title { padding-right: 40px; }
            }
        </style>

        <script>
            (function () {
                var modals = Array.prototype.slice.call(document.querySelectorAll('.site-modal'));
                if (!modals.length) return;

                // Sort by delay ascending so the queue order matches the intended schedule.
                modals.sort(function (a, b) {
                    return (parseInt(a.dataset.delay || '0', 10) || 0) -
                           (parseInt(b.dataset.delay || '0', 10) || 0);
                });

                var queue = [];
                var current = null;

                function openNext() {
                    if (current || !queue.length) return;
                    current = queue.shift();
                    current.hidden = false;
                    document.body.style.overflow = 'hidden';
                }

                function closeCurrent() {
                    if (!current) return;
                    current.hidden = true;
                    current = null;
                    document.body.style.overflow = '';
                    // Slight gap so the next modal doesn't appear in the same frame.
                    setTimeout(openNext, 250);
                }

                modals.forEach(function (modal) {
                    var delay = parseInt(modal.dataset.delay || '0', 10);
                    if (isNaN(delay) || delay < 0) delay = 0;

                    modal.querySelectorAll('[data-modal-close]').forEach(function (el) {
                        el.addEventListener('click', function () {
                            if (current === modal) closeCurrent();
                        });
                    });

                    setTimeout(function () {
                        queue.push(modal);
                        openNext();
                    }, delay * 1000);
                });

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && current) closeCurrent();
                });
            })();
        </script>
    @endif
@endsection
