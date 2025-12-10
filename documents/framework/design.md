# 設計

MVCS

composerはオートロードのみ利用している。

## 構成

src/以下がプロジェクト。

構成はLaravelに寄せているので、Laravelがわかる人は、比較的わかりやすいと思う。

```
app/ <- アプリケーション部分
  Commands/ <- 独自コマンド
  Controllers/ <- コントローラー
    Admin/ <- 管理画面
  Core/ <- フレームワークから呼び出すコアの部分を含む
    Callback.php <- フレームワークからのコールバックを受け取る
    Validator.php <- アプリケーションで利用するバリデーター
  Generators/ <- ジェネレーター
  Models/ <- DBモデル
  ModelsAnother/ <- 別DBを使う場合の実装例のDBモデル
  Services/ <- サービスクラス置き場
bin/ <- 実行ファイル置き場
  console <- コンソールコマンドエントリーポイント
boot/ <- 起動時共通処理
config/ <- 設定
  config.php <- 全般の設定
database/ <- データベース関連
public/ <- Webルート
  css/
  js/ <- Javascript
    app.js <- アプリケーション全体の管理を想定している。
    services/ <- Javascriptのサービスクラス置き場
  index.php <- Webのエントリーポイント
resources/ 
  lang/ <- 言語ファイル
  views/ <- Viewファイル
    admin/ <- 管理画面
routes/
  web.php <- ルート設定
SFW/ <- フレームワーク部分（本来ならvendor内にあるべき部分）
  src/ <- PHPクラス
  tests/ <- フレームワーク用のユニットテスト
  views/ <- フレームワークで使うview
storage/ <- 各種出力用
  logs/ <- ログファイル出力場所
  session/ <- セッションファイル出力場所
tests/ <- ユニットテスト
.env <- 環境変数
```
