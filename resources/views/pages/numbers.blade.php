@extends('layouts.app')

@section('content')
    <main class="main">
        <section class="specialties-hero">
            <div class="container">
                <div class="specialties-hero__panel">
                    <div class="specialties-hero__text">
                        <h1 class="specialties-hero__title">Цифры приема</h1>
                        <p class="specialties-hero__lead">
                            {{ \App\Models\Connection::get('Подзаголовок страницы «Цифры приема»') }}
                        </p>
                    </div>
                    <div class="specialties-hero__badge" aria-hidden="true">
                        <img src="{{asset('media/images/icons/цифры_приема.svg')}}" alt="" width="180" height="180">
                    </div>
                </div>
        </section>

        <section class="nums-section" aria-label="Контрольные цифры приема">
            <div class="container">
                @php
                    $budgetTotal = $specialities->sum('budget_places');
                    $commercialTotal = $specialities->sum('commercial_places');
                    $placesTotal = $budgetTotal + $commercialTotal;
                @endphp
                <ul class="nums-summary" role="list">
                    <li class="nums-summary__item">
                        <span class="nums-summary__label">Всего мест</span>
                        <span class="nums-summary__value">{{$placesTotal}}</span>
                    </li>
                    <li class="nums-summary__item">
                        <span class="nums-summary__label">Бюджет</span>
                        <span class="nums-summary__value">{{$budgetTotal}}</span>
                    </li>
                    <li class="nums-summary__item">
                        <span class="nums-summary__label">Коммерция</span>
                        <span class="nums-summary__value">{{$commercialTotal}}</span>
                    </li>
                </ul>
                <div class="nums-table-wrap">
                    <table class="nums-table">
                        <thead>
                        <tr>
                            <th scope="col" class="nums-th--n">№</th>
                            <th scope="col">Код</th>
                            <th scope="col">Специальность</th>
                            <th scope="col">Квалификация</th>
                            <th scope="col">Срок обучения</th>
                            <th scope="col" class="nums-th--num">Всего</th>
                            <th scope="col" class="nums-th--num">Бюджет</th>
                            <th scope="col" class="nums-th--num">Коммерция</th>
                            <th scope="col" class="nums-th--num nums-th--price">Стоимость за семестр</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($specialities as $i => $speciality)
                        @php($rowTotal = $speciality->budget_places + $speciality->commercial_places)
                        @php($semesterPrice = (int) floor(($speciality->price_per_year ?? 0) / 2))
                        <tr class="nums-row--link" data-href="{{route('view.speciality', $speciality)}}" tabindex="0" role="link">
                            <td data-label="№">{{$i + 1}}</td>
                            <td data-label="Код"><span class="nums-code">{{$speciality->code}}</span></td>
                            <td data-label="Специальность">{{$speciality->title}}</td>
                            <td data-label="Квалификация">{{$speciality->qualification ?? '—'}}</td>
                            <td data-label="Срок обучения">{{$speciality->duration}}</td>
                            <td data-label="Всего" class="nums-td--num nums-td--total">{{$rowTotal}}</td>
                            <td data-label="Бюджет" class="nums-td--num @if($speciality->budget_places === 0) nums-td--zero @endif">{{$speciality->budget_places}}</td>
                            <td data-label="Коммерция" class="nums-td--num @if($speciality->commercial_places === 0) nums-td--zero @endif">{{$speciality->commercial_places}}</td>
                            <td data-label="Стоимость за семестр" class="nums-td--num nums-td--price @if($semesterPrice === 0) nums-td--zero @endif">
                                @if($semesterPrice > 0)
                                    {{ number_format($semesterPrice, 0, '.', ' ') }} ₽
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">Нет активных специальностей.</td>
                        </tr>
                        @endforelse
                        </tbody>
                        @if($specialities->isNotEmpty())
                        <tfoot>
                        <tr class="nums-total">
                            <td colspan="5" class="nums-total__label">Итого</td>
                            <td class="nums-td--num nums-total__value">{{$placesTotal}}</td>
                            <td class="nums-td--num nums-total__value">{{$budgetTotal}}</td>
                            <td class="nums-td--num nums-total__value">{{$commercialTotal}}</td>
                            <td class="nums-td--num nums-total__value">—</td>
                        </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
