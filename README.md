# フリマアプリ（Laravel）

## プロジェクトの概要

本アプリケーションは、Laravelを用いて開発したフリマアプリです。  
ユーザーは会員登録を行い、商品を出品・閲覧・購入・コメント・いいねすることができます。  
また、メール認証機能を導入し、認証済みユーザーのみが一部機能を利用できるようにしています。

主な機能は以下の通りです。

- 会員登録・ログイン機能（Laravel Fortify）
- メール認証機能
- 商品一覧・商品詳細表示
- 商品出品機能
- 商品検索機能
- いいね機能
- コメント投稿機能
- 商品購入機能
- マイページ・プロフィール管理機能

---

## 環境構築手順

### 1. リポジトリをクローン
git clone git@github.com:Felina24/aufgabe1.git  
cd coachtech laravel aufgabe1

### 2. Dockerコンテナを起動
docker compose up -d --build

### 3. PHPコンテナに入る
docker compose exec php bash

### 4. ライブラリのインストール
composer install

### 5. 環境変数の設定
cp .env.example .env

※ .env は以下のように設定されています（開発環境）

APP_ENV=local  
APP_KEY=

DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass

MAIL_MAILER=smtp  
MAIL_HOST=mailhog  
MAIL_PORT=1025  
MAIL_FROM_ADDRESS=test@example.com  
MAIL_FROM_NAME="FleaMarketApp"

### 6. アプリケーションキーの生成
php artisan key:generate

### 7. マイグレーション・シーディング実行
php artisan migrate --seed

### 8. ブラウザでアクセス
- アプリケーション
http://localhost

- Mailhog（メール確認用）
http://localhost:8026

※ メール認証は Mailhog 上で確認します。

---

## 使用技術

### バックエンド
- PHP 8.1.34
- Laravel 8.83.8
- Laravel Fortify（認証・メール認証機能）

### フロントエンド
- Blade / CSS

### データベース
- MySQL 8.0.26

### インフラ・開発環境
- Docker（開発環境構築）
- Docker Compose（複数コンテナ管理）
- Nginx
- Mailhog（開発用メールサーバ）
- phpMyAdmin

---

## 管理者ユーザーおよび一般ユーザーのログイン情報
  
※ 以下は動作確認用のダミーアカウントです。

---

### 管理者ユーザー
本アプリケーションでは、管理者ユーザーの機能は実装していません。  
すべての操作は一般ユーザーとして行います。

### 一般ユーザー

- メールアドレス  
  user1@example.com

- パスワード  
  11111111
