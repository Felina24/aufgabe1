@extends('layouts.app')

@section('title', '商品出品')

@section('css')
<link rel="stylesheet" href="{{ asset('css/selling.css') }}">
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
<main class="sell-container">
    <h1 class="page-title">商品の出品</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <section class="section-block">
            <h2 class="section-title">商品画像</h2>

            <div class="image-upload-area">
                <label class="image-upload-button">
                    画像を選択する
                    <input type="file" id="imageInput" name="image" class="image-input" hidden>
                </label>

                <img id="previewImage" class="preview-image" style="display:none;">
            </div>
        </section>

        <section class="section-block">
            <h2 class="section-label">商品の詳細</h2>

            <h3 class="section-title">カテゴリー</h3>
            <div class="category-list">
                @foreach ($categories as $category)
                    <label class="tag">
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" class="category-checkbox" hidden>
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>

            <h3 class="section-title">商品の状態</h3>
            <select name="condition" class="select-box">
                <option value="">選択してください</option>
                <option value="良好">良好</option>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                <option value="状態が悪い">状態が悪い</option>
            </select>
        </section>

        <section class="section-block">
            <h2 class="section-label">商品名と説明</h2>

            <h3 class="section-title">商品名</h3>
            <input type="text" name="name" class="input-text">

            <h3 class="section-title">ブランド名</h3>
            <input type="text" name="brand_name" class="input-text">

            <h3 class="section-title">商品の説明</h3>
            <textarea name="description" class="textarea-box"></textarea>

            <h3 class="section-title">販売価格</h3>
            <input type="number" name="price" class="input-text price-input" placeholder="¥">
        </section>

        <button type="submit" class="submit-btn">出品する</button>

    </form>
</main>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('previewImage');

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(event) {
            preview.src = event.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".tag").forEach(tag => {
        tag.addEventListener("click", function () {
            const checkbox = this.querySelector(".category-checkbox");
            checkbox.checked = !checkbox.checked;

            this.classList.toggle("selected", checkbox.checked);
        });
    });
});
</script>
@endsection
