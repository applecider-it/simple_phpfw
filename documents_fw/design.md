# 設計

composerはオートロードのみ利用しています。

npmを利用しています。

## 構成

src/以下がプロジェクト。

構成はLaravelに寄せています。

```
app/ <- アプリケーション部分
  Commands/ <- 独自コマンド
  Controllers/ <- コントローラー
    Admin/ <- 管理画面
  Core/ <- フレームワークから呼び出すコアの部分を含む
    Callback.php <- フレームワークからのコールバックを受け取る
  Models/ <- DBモデル
  Services/ <- サービスクラス
  Validations/ <- バリデーション
bin/ <- 実行ファイル
  console <- コンソールコマンドエントリーポイント
boot/ <- 起動時共通処理
config/ <- 設定
  config.php <- 全般の設定
database/ <- データベース関連
public/ <- Webルート
  index.php <- Webのエントリーポイント
resources/ 
  css/
  js/
  lang/ <- 言語ファイル
  views/ <- Viewファイル
    admin/ <- 管理画面
routes/
  web.php <- ルート設定
simple-phpfw/ <- フレームワーク部分
  src/ <- PHPクラス
  tests/ <- フレームワーク用のユニットテスト
  views/ <- フレームワークで使うview
storage/ <- 各種出力用
  logs/ <- ログファイル出力場所
  session/ <- セッションファイル出力場所
tests/ <- ユニットテスト
.env <- 環境変数
```
