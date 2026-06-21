@extends('layouts.app')

@section('content')
    <main class="sp-main">
        <!-- HERO -->
        <section class="sp-hero">
            <div class="container">
                <a href="{{route('view.specialities')}}" class="sp-hero__back">
                    <span>← Все специальности</span>
                </a>

                <div class="sp-hero__card">
                    <div class="sp-hero__top">
                        <div class="sp-hero__head">
                            <h1 class="sp-hero__title">{{$speciality->title}}</h1>
                            @if($speciality->qualification)
                                <p class="sp-hero__qualification">{{$speciality->qualification}}</p>
                            @endif
                            <p class="sp-hero__code">{{$speciality->code}}</p>
                            <p class="sp-hero__dept">Цикловая комиссия «{{$speciality->cycleCommission->title}}»</p>
                        </div>
                        <div class="sp-hero__illustration" aria-hidden="true">
                            <img src="{{asset('storage/' . $speciality->image)}}" alt="">
                        </div>
                    </div>

                    <ul class="sp-metrics" role="list">
                        <li class="sp-metric sp-metric--wide">
                            <span class="sp-metric__value">{{$speciality->budget_places}}/{{$speciality->commercial_places}}</span>
                            <span class="sp-metric__label">бюджетных мест / коммерческих мест</span>
                        </li>
                        <li class="sp-metric">
                            <span class="sp-metric__value">{{ number_format($speciality->price_per_year, 0, '.', ' ') }} ₽</span>
                            <span class="sp-metric__label">стоимость за год обучения</span>
                        </li>
                        <li class="sp-metric">
                            <span class="sp-metric__value">{{$speciality->duration}}</span>
                            <span class="sp-metric__label">длительность обучения</span>
                        </li>
                        <li class="sp-metric">
                            <span class="sp-metric__value">9 классов</span>
                            <span class="sp-metric__label">на базе</span>
                        </li>
                        <li class="sp-metric">
                            <span class="sp-metric__value">{{$speciality->study_form_label}}</span>
                            <span class="sp-metric__label">форма обучения</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- О ПРОГРАММЕ -->
        <section class="sp-section sp-about" aria-labelledby="sp-about-title">
            <div class="container sp-section__inner">
                <div class="sp-section__head">
                    <h2 id="sp-about-title" class="sp-section__title">О программе</h2>
                </div>
                <div class="sp-about__body">
                    <p class="sp-about__lead">{{$speciality->description_title}}</p>
                    <p class="sp-about__text">{{$speciality->description}}</p>

                    @if(!empty($speciality->stacks))
                    <ul class="sp-about__tags" role="list">
                        @foreach($speciality->stacks as $stack)
                        <li>{{$stack['title']}}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </section>

        <!-- ТЫ НАУЧИШЬСЯ -->
        <section class="sp-section sp-learn" aria-labelledby="sp-learn-title">
            <div class="container sp-section__inner">
                <div class="sp-section__head">
                    <h2 id="sp-learn-title" class="sp-section__title">Ты научишься</h2>
                </div>

                <div class="sp-learn__grid">
                    @foreach($speciality->skills ?? [] as $i => $skill)
                    <article class="sp-learn__card" style="--i:{{$i}}">
                        <span class="sp-learn__num">{{str_pad($i + 1, 2, '0', STR_PAD_LEFT)}}</span>
                        <p>{{$skill['description']}}</p>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- КЕМ БУДЕШЬ РАБОТАТЬ -->
        <section class="sp-section sp-career" aria-labelledby="sp-career-title">
            <div class="container sp-section__inner">
                <div class="sp-section__head">
                    <h2 id="sp-career-title" class="sp-section__title">Кем будешь работать</h2>
                </div>

                <ul class="sp-career__list" role="list">
                    @foreach($speciality->careers ?? [] as $career)
                    <li class="sp-career__chip">{{$career['title']}}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        <!-- ПРОФИЛЬНЫЕ ПРЕДМЕТЫ -->
        <section class="sp-section sp-subjects" aria-labelledby="sp-subjects-title">
            <div class="container sp-section__inner">
                <div class="sp-section__head">
                    <h2 id="sp-subjects-title" class="sp-section__title">Профильные предметы</h2>
                </div>

                <ul class="sp-subjects__grid" role="list">
                    @foreach($speciality->core_subjects ?? [] as $i => $subject)
                    <li class="sp-subjects__card"><span class="sp-subjects__num">{{str_pad($i + 1, 2, '0', STR_PAD_LEFT)}}</span><span>{{$subject['title']}}</span></li>
                    @endforeach
                </ul>
            </div>
        </section>

        <!-- ПРЕПОДАВАТЕЛИ -->
        <section class="sp-section sp-staff" aria-labelledby="sp-staff-title">
            <div class="container sp-section__inner">

                @php
                    $people = [];

                    $cc = $speciality->cycleCommission;
                    if ($cc && $cc->head) {
                        $people[] = [
                            'teacher' => $cc->head,
                            'role'    => 'Председатель цикловой комиссии «' . $cc->title . '»',
                            'badge'   => 'ЦК',
                        ];
                    }

                    $dept = $speciality->department;
                    if ($dept && $dept->head) {
                        $people[] = [
                            'teacher' => $dept->head,
                            'role'    => 'Заведующая отделением «' . $dept->title . '»',
                            'badge'   => $dept->head->cabinet ? 'каб. ' . $dept->head->cabinet : null,
                        ];
                    }

                    if ($universalDepartment && $universalDepartment->head
                        && (!$dept || $universalDepartment->id !== $dept->id)) {
                        $people[] = [
                            'teacher' => $universalDepartment->head,
                            'role'    => 'Заведующая отделением «' . $universalDepartment->title . '»',
                            'badge'   => $universalDepartment->head->cabinet ? 'каб. ' . $universalDepartment->head->cabinet : null,
                        ];
                    }
                @endphp

                <div class="sp-staff__grid">
                    @foreach($people as $person)
                    @php($teacher = $person['teacher'])
                    <article class="sp-person">
                        <div class="sp-person__photo-wrap">
                            <img src="{{ $teacher->image ? asset('storage/' . $teacher->image) : asset('media/images/teachers/dinar.jpeg') }}" alt="" class="sp-person__photo">
                            @if($person['badge'])
                            <span class="sp-person__badge">{{$person['badge']}}</span>
                            @endif
                        </div>
                        <div class="sp-person__body">
                            <p class="sp-person__role">{{$person['role']}}</p>
                            <h3 class="sp-person__name">{{$teacher->full_name}}</h3>

                            @if($teacher->phone || $teacher->email)
                            <div class="sp-person__links">
                                @if($teacher->phone)
                                <a class="sp-person__link" href="tel:{{ preg_replace('/\D/', '', $teacher->phone) }}">
                                    <img src="{{asset('media/images/icons/phone.svg')}}" alt="" width="18" height="18">
                                    <span>{{ $teacher->formatted_phone }} @if($teacher->extension_phone)<em>доб. {{$teacher->extension_phone}}</em>@endif</span>
                                </a>
                                @endif
                                @if($teacher->email)
                                <a class="sp-person__link" href="mailto:{{$teacher->email}}">
                                    <img src="{{asset('media/images/icons/email.svg')}}" alt="" width="18" height="18">
                                    <span>{{$teacher->email}}</span>
                                </a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        @if($speciality->specialty_document)
        <section class="sp-section sp-document">
            <div class="container sp-section__inner">
                <a href="{{asset('storage/' . $speciality->specialty_document)}}" class="sp-document__link"
                   target="_blank" rel="noopener" download>
                    <img src="{{asset('media/images/icons/документы.svg')}}" alt="" width="20" height="20">
                    <span>Скачать документ специальности «{{$speciality->title}}»</span>
                    <span class="sp-document__arrow" aria-hidden="true">↓</span>
                </a>
            </div>
        </section>
        @endif
    </main>
@endsection
