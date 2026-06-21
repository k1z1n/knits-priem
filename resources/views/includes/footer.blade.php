@php($footerContact = \App\Models\Commission::first())
<footer class="footer" id="contacts">
    <div class="container footer__inner">
        <div class="footer__top">
            <div class="footer__col">
                <a href="{{route('view.main')}}" class="brand brand--footer" aria-label="МЦК-КТИТС">
                    <img src="{{asset('media/images/logo/white.svg')}}" alt="Логотип МЦК-КТИТС" class="brand__logo">
                </a>
            </div>
            <div class="footer__col">
                <p class="footer__title">Навигация</p>
                <ul class="footer-links">
                    <li><a href="{{route('view.main')}}">Главная</a></li>
                    <li><a href="{{route('view.specialities')}}">Специальности</a></li>
                    <li><a href="{{route('view.documents')}}">Документы</a></li>
                    <li><a href="{{route('view.faq')}}">Вопрос-ответ</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <p class="footer__title">Поступление</p>
                <ul class="footer-links">
                    <li><a href="{{route('view.numbers')}}">Цифры контрольного приема</a></li>
                    <li><a href="#podachazayavleni">Условия подачи заявления</a></li>
                    <li><a href="#podachazayavleni">Подать заявление</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <p class="footer__title">Контакты</p>
                <ul class="contacts">
                    @if($footerContact?->email)
                        <li>
                            <img src="{{asset('media/images/icons/email.svg')}}" alt="" width="20" height="20">
                            <a href="mailto:{{ $footerContact->email }}">{{ $footerContact->email }}</a>
                        </li>
                    @endif
                    @if($footerContact?->address)
                        <li>
                            <img src="{{asset('media/images/icons/adress.svg')}}" alt="" width="20" height="20">
                            <span>{{ $footerContact->address }}</span>
                        </li>
                    @endif
                    @if($footerContact?->phone)
                        <li>
                            <img src="{{asset('media/images/icons/phone.svg')}}" alt="" width="20" height="20">
                            <a href="tel:+{{ preg_replace('/\D/', '', $footerContact->phone) }}">{{ $footerContact->formatted_phone }}@if($footerContact->extension_phone) {{ $footerContact->extension_phone }}@endif</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <p class="footer__bottom">© {{ date('Y') }} Приемная комиссия МЦК-КТИТС. Все права защищены.</p>
    </div>
</footer>
