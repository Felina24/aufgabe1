@extends('layouts.app')
@section('main-class', 'no-center')

@section('title', 'マイリスト')

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
<button class="header-btn primary">出品</button>
@endsection


@section('content')

<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/products.css') }}">

<div class="product-main">

    <div class="tab-menu">
        <a href="{{ route('products.index') }}" class="tab-link">おすすめ</a>
        <a href="{{ route('products.mylist') }}" class="tab-link active">マイリスト</a>
    </div>

    <hr class="tab-border">

    <div class="product-list">

        @forelse ($items as $item)
        <div class="product-card">
            <a href="{{ route('products.show', $item->id) }}">
                <div class="product-image">
                    <img src="{{ asset('storage/' . $item->image_path) }}"
                        alt="{{ $item->name }}"
                        style="width:100%; height:100%; object-fit:cover;">
                </div>
            </a>

            <p class="product-name">{{ $item->name }}</p>
            @if ($item->purchase)
                <div class="sold-label">Sold</div>
            @endif
        </div>
        @empty
        @endforelse

    </div>

</div>
@endsection
