# 設計

## 構成

PHPをモノリスにする。

websocketはPHPのマイクロサービス。

```
ws/ <- PHPマイクロサービス
  documents/ <- PHPマイクロサービス固有のドキュメント
src/ <- PHPモノリス
  documents/ <- PHPモノリス固有のドキュメント
documents/ <- 全体のドキュメント
```
