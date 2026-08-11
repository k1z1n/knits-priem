/* Липкая верхушка: плашка-объявление + шапка.
   Кладём фактические высоты в CSS-переменные, чтобы шапка липла ровно под
   плашкой, а thead таблиц — под ними обеими (высота плашки переменная). */
(function () {
    const bar = document.querySelector('.announcement-bar');
    const header = document.querySelector('.site-header');
    const root = document.documentElement;

    const sync = () => {
        const barH = bar ? bar.offsetHeight : 0;
        const headerH = header ? header.offsetHeight : 0;
        root.style.setProperty('--sticky-bar-h', barH + 'px');
        root.style.setProperty('--sticky-top-h', (barH + headerH) + 'px');
    };

    sync();
    window.addEventListener('resize', sync);
    if ('ResizeObserver' in window) {
        const ro = new ResizeObserver(sync);
        if (bar) ro.observe(bar);
        if (header) ro.observe(header);
    }
})();

const burger = document.querySelector('.site-burger');
const nav = document.querySelector('.site-nav');

if (burger && nav) {
    burger.addEventListener('click', (e) => {
        e.stopPropagation();
        const open = burger.classList.toggle('is-open');
        nav.classList.toggle('is-open', open);
        burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    document.addEventListener('click', (e) => {
        if (!nav.contains(e.target) && !burger.contains(e.target)) {
            burger.classList.remove('is-open');
            nav.classList.remove('is-open');
            burger.setAttribute('aria-expanded', 'false');
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            burger.classList.remove('is-open');
            nav.classList.remove('is-open');
            burger.setAttribute('aria-expanded', 'false');
        }
    });
}

/* Scroll reveal */
const revealTargets = [
    ...document.querySelectorAll('.quick-link-card'),
    ...document.querySelectorAll('.admission-steps__head'),
    ...document.querySelectorAll('.admission-notice'),
];

revealTargets.forEach((el, i) => {
    el.classList.add('reveal');
    el.style.setProperty('--reveal-delay', `${(i % 6) * 90}ms`);
});

const flowItems = [...document.querySelectorAll('.admission-flow__item')];

if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

    revealTargets.forEach((el) => io.observe(el));
    flowItems.forEach((el) => io.observe(el));
} else {
    revealTargets.forEach((el) => el.classList.add('is-visible'));
    flowItems.forEach((el) => el.classList.add('is-visible'));
}

/* Кликабельные строки таблицы */
document.querySelectorAll('.nums-row--link').forEach((row) => {
    const go = () => {
        const href = row.getAttribute('data-href');
        if (href) window.location.href = href;
    };
    row.addEventListener('click', go);
    row.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            go();
        }
    });
});

/* Countdown в плашке-объявлении */
(function () {
    const timers = document.querySelectorAll('.announcement-bar__timer');
    if (!timers.length) return;

    const pad = (n) => (n < 10 ? '0' + n : '' + n);

    const pluralDays = (n) => {
        const mod10 = n % 10;
        const mod100 = n % 100;
        if (mod10 === 1 && mod100 !== 11) return 'день';
        if (mod10 >= 2 && mod10 <= 4 && (mod100 < 12 || mod100 > 14)) return 'дня';
        return 'дней';
    };

    const update = () => {
        const now = Date.now();
        timers.forEach((el) => {
            const target = new Date(el.dataset.deadline).getTime();
            const total = Math.max(0, Math.floor((target - now) / 1000));
            const days = Math.floor(total / 86400);
            const hours = Math.floor((total % 86400) / 3600);
            const minutes = Math.floor((total % 3600) / 60);
            const seconds = total % 60;
            el.textContent = `${days} ${pluralDays(days)} ${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
        });
    };

    update();
    setInterval(update, 1000);
})();

/* Scroll-to-top */
const scrollTopBtn = document.querySelector('.scroll-top');
if (scrollTopBtn) {
    const toggle = () => {
        scrollTopBtn.classList.toggle('is-visible', window.scrollY > 400);
    };
    toggle();
    window.addEventListener('scroll', toggle, { passive: true });
    scrollTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}
