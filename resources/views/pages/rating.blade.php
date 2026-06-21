@extends('layouts.app')

@section('content')
<style>
    .rating-page {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .rating-toggle {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 32px;
    }

    .rating-toggle__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.2;
        text-decoration: none;
        border-radius: 10px;
        border: 2px solid #1a3d5c;
        background: #ffffff;
        color: #1a3d5c;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .rating-toggle__btn:hover {
        background: #f0f5fa;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(26, 61, 92, 0.15);
    }

    .rating-toggle__btn--active {
        background: #1a3d5c;
        color: #ffffff;
        border-color: #1a3d5c;
        box-shadow: 0 4px 12px rgba(26, 61, 92, 0.25);
    }

    .rating-toggle__btn--active:hover {
        background: #142e44;
        border-color: #142e44;
        color: #ffffff;
    }

    .rating-content {
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        overflow-x: auto;
    }

    .rating-content table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .rating-content table th,
    .rating-content table td {
        padding: 10px 12px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: top;
    }

    .rating-content table th {
        background: #f8fafc;
        font-weight: 600;
        color: #1a3d5c;
        position: sticky;
        top: 0;
    }

    .rating-content table tr:hover {
        background: #f9fafb;
    }

    .rating-empty {
        padding: 24px;
        background: #fff8e1;
        border: 1px solid #ffe082;
        border-radius: 10px;
        color: #856404;
        text-align: center;
    }

    @media (max-width: 640px) {
        .rating-page {
            padding: 20px 12px;
        }
        .rating-toggle__btn {
            flex: 1 1 100%;
            padding: 12px 16px;
            font-size: 14px;
        }
        .rating-content {
            padding: 12px;
        }
        .rating-content table {
            font-size: 13px;
        }
    }
</style>

<div class="rating-page">
    <div class="rating-toggle">
        <a href="/rating?id=0"
           class="rating-toggle__btn {{ $currentId === '0' ? 'rating-toggle__btn--active' : '' }}">
            Оригинал + копия аттестата
        </a>
        <a href="/rating?id=1"
           class="rating-toggle__btn {{ $currentId === '1' ? 'rating-toggle__btn--active' : '' }}">
            Оригинал аттестатов
        </a>
    </div>

    @if ($content)
        <div class="rating-content">
            {!! $content !!}
        </div>
    @else
        <div class="rating-empty">
            Не удалось загрузить рейтинг. Попробуйте обновить страницу через минуту.
        </div>
    @endif
</div>
@endsection
