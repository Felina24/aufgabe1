@extends('layouts.app')

@section('title', 'プロフィール設定')

@section('header-center')
<input type="text" class="search-box" placeholder="何を探していますか？">
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
<h1>プロフィール設定</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form class="register-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="profile-image-area">
    <div class="profile-circle">
    <img 
        src="{{ isset($profile->icon_path) ? asset('storage/' . $profile->icon_path) : '' }}"
        class="profile-preview"
        style="width:150px; height:150px; object-fit:cover; border-radius:50%;"
    >
    </div>

    <label class="upload-btn">
        画像を選択する
        <input type="file" name="profile_image" accept="image/*">
    </label>
    </div>

    <label>ユーザー名</label>
    <input type="text" name="username" required value="{{ old('username', $profile->username) }}">

    <label>メールアドレス</label>
    <input type="email" value="{{ $user->email }}" disabled>

    <label>郵便番号</label>
    <input type="text" name="zip" value="{{ old('zip', $profile->zip) }}">

    <label>住所</label>
    <input type="text" name="address" value="{{ old('address', $profile->address) }}">

    <label>建物名</label>
    <input type="text" name="building_name" value="{{ old('building_name', $profile->building) }}">

    <button type="submit" class="submit-btn">変更する</button>
</form>

<script>
    document.querySelector('input[name="profile_image"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(event) {
            document.querySelector('.profile-preview').src = event.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection