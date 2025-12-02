# /SFW/src/

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
Output/ <- 出力関連
  View.php <- View管理
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