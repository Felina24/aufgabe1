@extends('layouts.app')

@section('title', 'メール認証')

@section('content')
<div class="confirmation">
    <p class="confirmation-message">
        登録いただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了してください。
    </p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="confirm-btn">
            認証メールを再送する
        </button>
    </form>

    @if (session('status') == 'verification-link-sent')
        <p class="confirmation-message">
            認証メールを再送しました。
        </p>
    @endif
</div>
@endsection
