@extends('layouts.app')
@section('main-class', 'no-center')

@section('title', '商品一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('header-center')
<form action="{{ route('products.search') }}" method="GET">
    <input type="text"
           name="keyword"
           value="{{ request('keyword') }}"
           class="search-box"
           placeholder="何を探していますか？">
</form>
@endsection

@section('header-right')
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="header-btn">ログアウト</button>
</form>

<a href="{{ route('mypage') }}" class="header-btn">マイページ</a>
<a href="{{ route('products.store') }}" class="header-btn primary">出品</a>
@endsection

@section('content')

<div class="product-main">

    <div class="tab-menu">
        <a href="{{ route('products.search') }}" class="tab-link active">おすすめ</a>
        <a href="{{ route('products.mylist') }}" class="tab-link">マイリスト</a>
    </div>

    <hr class="tab-border">

    <div class="product-list">
        @foreach ($items as $item)
            <div class="product-card">
                <a href="{{ route('products.show', $item->id) }}">
                    <div class="product-image">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="">
                    </div>
                </a>

                <p class="product-name">{{ $item->name }}</p>
                @if ($item->purchase)
                    <div class="sold-label">Sold</div>
                @endif
            </div>
        @endforeach
    </div>

</div>

@endsection
