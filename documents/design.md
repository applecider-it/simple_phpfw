# 設計

MVCS

composerはオートロードのみ利用している。

## 構成

src/以下がプロジェクト。

```
App/ <- アプリケーション部分
  Commands/ <- 独自コマンド
  Controllers/ <- コントローラー
  Core/ <- フレームワークから呼び出すコアの部分を含む
  Models/ <- DBモデル
  Services/ <- サービスクラス置き場
bin/ <- 実行ファイル置き場
  server <- テスト用サーバー
  console <- 独自コマンドエントリーポイント
boot/ <- 起動時共通処理
config/ <- 設定
database/ <- データベース関連
public/ <- Webルート
resources/ 
  views/ <- Viewファイル
  lang/ <- 言語ファイル
SFW/ <- フレームワーク部分（本来ならvendor内にあるべき部分）
  src/ <- PHPクラス
  views/ <- フレームワークで使うview
  tests/ <- フレームワーク用のユニットテスト
storage/ <- 各種出力用
tests/ <- ユニットテスト
.env <- 環境変数
```
