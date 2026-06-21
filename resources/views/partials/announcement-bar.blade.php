@php($announcementBar = \App\Models\AnnouncementBar::active())

@if($announcementBar)
    <div class="announcement-bar" role="region" aria-label="Объявление">
        <div class="container announcement-bar__inner">
            <span class="announcement-bar__icon" aria-hidden="true">!</span>
            <p class="announcement-bar__text">{!! $announcementBar->renderText() !!}</p>
        </div>
    </div>
@endif
