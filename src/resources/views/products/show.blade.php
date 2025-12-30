@extends('layouts.app')

@section('title', '商品詳細')

@section('main-class', 'product-detail')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product-show.css') }}">
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
<div class="product-container">

    <div class="product-image-box">
        @if ($item->image_path)
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="" class="product-image">
        @else
            <div class="no-image"></div>
        @endif
    </div>

    <div class="product-info">

        <h1 class="product-name">{{ $item->name }}</h1>
        @if ($item->purchase)
            <div class="sold-label">Sold</div>
        @endif

        <p class="brand">{{ $item->brand_name ?? 'ブランド不明' }}</p>

        <p class="price">¥{{ number_format($item->price) }} <span>（税込）</span></p>

        <div class="icon-row">

            <div class="icon-item">
                <form method="POST" action="{{ route('products.like', $item->id) }}">
                    @csrf
                    <button type="submit" style="background:none; border:none; cursor:pointer;">
                        @if ($isLiked)
                            <img src="{{ asset('img/heart_on.png') }}" alt="いいね済">
                        @else
                            <img src="{{ asset('img/heart_off.png') }}" alt="いいね">
                        @endif
                    </button>
                </form>
                <span>{{ $likeCount }}</span>
            </div>

            <div class="icon-item">
                <img src="{{ asset('img/comment_icon.png') }}" alt="コメント">
                <span>{{ $item->comments->count() ?? 0 }}</span>
            </div>

        </div>

        @if ($item->purchase)
            <a class="buy-btn disabled-btn">
                購入手続きへ
            </a>
        @else
            <a href="{{ route('purchase.show', ['id' => $item->id]) }}" class="buy-btn">
                購入手続きへ
            </a>
        @endif

        <section class="section-block">
            <h2>商品説明</h2>
            <p>{{ $item->description }}</p>
        </section>

        <section class="section-block">
            <h2>商品の情報</h2>

            <div class="info-row">
                 <span class="label">カテゴリー</span>
                @if ($item->categories->count() > 0)
                    <div class="category-list">
                        @foreach ($item->categories as $category)
                            <span class="category-tag">{{ $category->name }}</span>

                            @if (!$loop->last)
                                <span class="category-separator"> / </span>
                            @endif
                        @endforeach
                    </div>
                @else
                    <span class="no-category">未設定</span>
                @endif
            </div>

            <div class="info-row">
                <span class="label">商品の状態</span>
                <span>{{ $item->status ?? '不明' }}</span>
            </div>
        </section>

        <section class="section-block">
            <h2>コメント({{ $item->comments->count() ?? 0 }})</h2>

            @foreach ($item->comments as $comment)
                <div class="comment-box">
                    <div class="comment-icon">
                    @if ($comment->user->profile && $comment->user->profile->icon_path)
                        <img src="{{ asset('storage/' . $comment->user->profile->icon_path) }}"
                            alt="{{ $comment->user->name }}"
                            class="comment-user-icon">
                    @else
                        <img src="{{ asset('img/default_user.png') }}" class="comment-user-icon">
                    @endif
                </div>

                    <div class="comment-content">
                        <p class="comment-user">{{ $comment->user->name }}</p>
                        <p class="comment-text">{{ $comment->content }}</p>
                    </div>

                </div>
            @endforeach

            <form action="{{ route('comments.store', $item->id) }}" method="POST">
                @csrf
                <textarea name="content" class="comment-input" placeholder="商品へのコメントを入力してください"></textarea>

                @error('content')
                    <p style="color:red; font-size:14px;">{{ $message }}</p>
                @enderror

                <button type="submit" class="comment-btn">コメントを送信する</button>
            </form>
        </section>

        <a href="{{ route('products.index') }}" class="back-link">商品一覧に戻る</a>

    </div>

</div>
@endsection