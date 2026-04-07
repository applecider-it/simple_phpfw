# シンプルPHPフレームワークモノリス

## 実装内容

- [ツイート機能](./features/tweet.md)

## モデル

`id`, `created_at`, `updated_at`, `deleted_at`の説明は省略しています。

- [ユーザー](./Models/User.md)
  - [ユーザーツイート](./Models/User/Tweet.md)
- [管理者](./Models/AdminUser.md)

## コンテナ

| 項目名 | 内容 | 型 | 詳細 |
|--------|--------|--------|--------|
| adminUser | 管理画面のログインユーザー | App\Services\AdminUser\AuthService \| null |  |
| breadcrumbs | パンくず | App\Services\Nav\BreadcrumbsService |  |
| user | ログインユーザー | App\Services\User\AuthService \| null |  |

## ルート

### options

| 項目名 | 内容 | 型 | 詳細 |
|--------|--------|--------|--------|
| auth | 認証の指定 | string | `user` \| `admin_user` |
