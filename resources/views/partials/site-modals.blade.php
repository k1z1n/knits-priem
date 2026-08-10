@php
    $siteModals = \App\Models\Modal::where('is_active', true)->orderBy('delay_seconds')->get();
    $siteModalCommission = $siteModals->isNotEmpty() ? \App\Models\Commission::query()->first() : null;
@endphp

@if($siteModals->isNotEmpty())
    @foreach($siteModals as $siteModal)
        <div class="site-modal" data-delay="{{ $siteModal->delay_seconds }}" role="dialog" aria-modal="true"
             aria-labelledby="site-modal-title-{{ $siteModal->id }}" hidden>
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
                    <h3 id="site-modal-title-{{ $siteModal->id }}" class="site-modal__title">{{ $siteModal->title }}</h3>
                </div>
                <div class="site-modal__body">{!! nl2br($siteModal->renderDescription($siteModalCommission)) !!}</div>
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
