@extends('layouts.app')

@section('title', '購入した商品')
@section('main-class', '') 

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('header-center')
<form action="{{ route('products.index') }}" method="GET">
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

<div class="profile-image-area">

    <div class="profile-circle">
        @if ($profile && $profile->icon_path)
            <img src="{{ asset('storage/' . $profile->icon_path) }}" alt="profile icon">
        @endif
    </div>

    <div class="profile-info">
        <div class="profile-header-row">
            <p class="profile-name">{{ Auth::user()->name }}</p>
            <a href="{{ route('profile.edit') }}" class="edit-profile-btn">
                プロフィールを編集
            </a>
        </div>
    </div>

</div>

<div class="product-main">
    <div class="tab-menu">
        <a href="{{ route('mypage') }}" class="tab-link">出品した商品</a>
        <a href="{{ route('mypage.bought') }}" class="tab-link active">購入した商品</a>
        <a href="{{ route('products.index') }}" class="tab-link">おすすめへ戻る</a>
    </div>

    <hr class="tab-border">

    <div class="product-list">
        @forelse ($boughtItems as $item)
            <div class="product-card">
                <a href="{{ route('products.show', $item->id) }}">
                    <div class="product-image">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="">
                    </div>
                    <p class="product-name">{{ $item->name }}</p>
                </a>
            </div>
        @empty
        @endforelse
    </div>
</div>
@endsection