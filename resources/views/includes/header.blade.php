<header class="site-header">
    <div class="container site-header__inner">
        <a href="/" class="site-header__brand" aria-label="Главная">
            <img src="{{asset('media/images/logo/1.png')}}" alt="" width="48" height="48">
        </a>
        <nav class="site-nav" aria-label="Основная навигация">
            <a href="{{route('view.specialities')}}" class="site-nav__link @if(request()->routeIs('view.specialities')) site-nav__link--active @endif">Специальности</a>
            <a href="{{route('view.numbers')}}" class="site-nav__link @if(request()->routeIs('view.numbers')) site-nav__link--active @endif">Цифры приема</a>
            @if(\App\Models\PageSetting::enabled('rating'))
                <a href="{{route('view.rating')}}" class="site-nav__link @if(request()->routeIs('view.rating')) site-nav__link--active @endif">Рейтинг</a>
            @endif
            <a href="{{route('view.documents')}}" class="site-nav__link @if(request()->routeIs('view.documents')) site-nav__link--active @endif">Документы</a>
            <a href="{{route('view.faq')}}" class="site-nav__link @if(request()->routeIs('view.faq')) site-nav__link--active @endif">FAQ</a>
            <a href="{{route('view.contacts')}}" class="site-nav__link @if(request()->routeIs('view.contacts')) site-nav__link--active @endif">Контакты</a>
            <a href="https://mck-ktits.ru/" class="site-nav__link">Вернуться на сайт МЦК-КТИТС</a>
        </nav>
        <button class="site-burger" type="button" aria-label="Меню" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>
