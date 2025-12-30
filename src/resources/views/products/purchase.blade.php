@extends('layouts.app')
@section('main-class', 'no-center')
@section('title', '商品購入')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
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
<form action="{{ route('purchase.store', $item->id) }}" method="POST">
@csrf

<main class="purchase-container">

    <div class="product-info">

        <div class="product-top">
            <div class="product-image-box">
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="商品画像" class="product-image">
            </div>

            <div class="product-details">
                <h2 class="product-title">{{ $item->name }}</h2>
                <p class="product-price">￥{{ number_format($item->price) }}</p>
            </div>
        </div>

        <hr class="divider">

        <section class="payment-method">
            <h3>支払い方法</h3>
            <select name="payment_method" class="payment-select" id="payment-select" required>
                <option value="">選択してください</option>
                <option value="コンビニ払い">コンビニ払い</option>
                <option value="クレジットカード">クレジットカード</option>
            </select>
        </section>

        <hr class="divider">

        <section class="shipping">
            <div class="shipping-header">
                <h3>配送先</h3>
                <a href="{{ route('address.edit', ['item_id' => $item->id]) }}" class="change-link">変更する</a>
            </div>

            <p class="shipping-text">
                〒 {{ $address->zip ?? '未登録' }}<br>
                {{ $address->address ?? '住所未登録' }}<br>
                {{ $address->building ?? '' }}
            </p>
        </section>

        <hr class="divider">

    </div>

    <div class="summary-area">

        <div class="summary-box">
            <div class="summary-row">
                <span>商品代金</span>
                <span class="summary-price">￥{{ number_format($item->price) }}</span>
            </div>

            <div class="summary-row">
                <span>支払い方法</span>
                <span id="selected-payment">未選択</span>
            </div>
        </div>

        <button type="submit" class="buy-btn">購入する</button>

    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const select = document.getElementById("payment-select");
        const display = document.getElementById("selected-payment");

        select.addEventListener("change", function () {
            const value = select.value || "未選択";
            display.textContent = value;
        });
    });
</script>

@endsection
