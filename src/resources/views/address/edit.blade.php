@extends('layouts.app')

@section('title', '住所変更')

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
<main class="container">
    <h1>住所の変更</h1>

    <form action="{{ route('address.update', ['item_id' => $item->id]) }}" method="POST" class="register-form">
        @csrf

        <label>郵便番号</label>
        <input type="text" name="zip" value="{{ old('zip', $address->zip) }}" required>

        <label>住所</label>
        <input type="text" name="address" value="{{ old('address', $address->address) }}" required>

        <label>建物名</label>
        <input type="text" name="building" value="{{ old('building', $address->building) }}">

        <button type="submit" class="submit-btn">変更する</button>
    </form>
    
    <a href="{{ route('purchase.show', ['id' => $item->id]) }}" class="back-link">戻る</a>
</main>
@endsection
