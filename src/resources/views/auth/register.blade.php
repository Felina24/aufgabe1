@extends('layouts.app')

@section('title', '会員登録')

@section('content')
<h1>会員登録</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form class="register-form" method="POST" action="{{ route('register') }}">
    @csrf

    <label>ユーザー名</label>
    <input type="text" name="name" value="{{ old('name') }}">

    <label>メールアドレス</label>
    <input type="text" name="email" value="{{ old('email') }}">

    <label>パスワード</label>
    <input type="password" name="password">

    <label>確認用パスワード</label>
    <input type="password" name="password_confirmation">

    <button type="submit" class="submit-btn">登録する</button>
</form>

<p class="login-link">
    <a href="{{ route('login') }}">ログインはこちら</a>
</p>
@endsection