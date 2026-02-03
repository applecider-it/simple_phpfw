# メイン

## /simple-phpfw/src/

```
Boot/ <- ブート時の処理管理
  Common.php <- Web、コンソール共通の起動処理
  Console.php <- コンソールの起動処理
  Web.php <- Webの起動処理
Console/ <- コンソール関連
  Commands/ <- システムで用意してあるコマンド
  ・
  ・
Core/ <- フレームワークのコアの部分をまとめている
  App.php <- サービスコンテナへのアクセス管理
  Container.php <- サービスコンテナ
  ・
  ・
Data/ <- 各種変数管理
  ・
  ・
Database/ <- データベース管理
  DB.php <- DB処理
  Model.php <- モデルのベースクラス
  Query.php <- クエリービルダー
Exceptions/ <- フレームワークで利用する例外
  ・
  ・
Generator/ <- ジェネレーター管理
  ・
  ・
JWT/ <- JWT管理
  ・
  ・
Output/ <- 出力関連
  View.php <- View管理
  ・
  ・
Pagination/ <- 改ページ管理
  ・
  ・
Test/ <- ユニットテスト処理
  ・
  ・
Validation/ <- バリデーション処理
  Validator.php <- バリデーターベースクラス
Web/ <- Web関連
  ・
  ・
```

## ルート

### options

下記以外は任意で利用可能。

| 項目名 | 内容 | 型 | 詳細 |
|--------|--------|--------|--------|
| nosession | セッション不使用フラグ | boolean | `true`の場合はセッションを開始しない。 |


## フレームワークで利用している定数

| 項目名 | 内容 | 型 | 詳細 |
|--------|--------|--------|--------|
| SFW_PROJECT_ROOT | プロジェクトルート | string |  |
| SFW_BOOT_TYPE | 起動タイプ | string | `web` \| `console` |


