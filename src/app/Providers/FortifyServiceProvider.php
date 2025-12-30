<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Contracts\RegisterResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // --- Fortify のビュー設定 ---
        Fortify::loginView(fn () => view('auth.login'));
        Fortify::registerView(fn () => view('auth.register'));
        Fortify::verifyEmailView(fn () => view('auth.verify-email'));

        // --- Fortify のユーザー登録ロジックを使用 ---
        Fortify::createUsersUsing(CreateNewUser::class);

        // --- 会員登録成功後だけリダイレクト先を変更 ---
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request)
            {
                // 登録後 → プロフィール設定ページへ
                return redirect('/mypage/profile');
            }
        });
    }
}
