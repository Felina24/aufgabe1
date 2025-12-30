@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<h1>ログイン</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form class="register-form" method="POST" action="{{ route('login') }}">
    @csrf

    <label>メールアドレス</label>
    <input type="text" name="email" value="{{ old('email') }}">
    
    <label>パスワード</label>
    <input type="password" name="password">

    <button type="submit" class="submit-btn">ログインする</button>

    <p class="login-link">
        <a href="{{ route('register') }}">会員登録はこちら</a>
    </p>
</form>
@endsection
