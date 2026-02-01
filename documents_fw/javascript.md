# Javascript

viteとかはつかわないで、バニラJSで、importmapを使っている。

CSSも同様にviteなどは利用していない。

Javascriptは、moduleのみ利用している。

## 構成

```
config/
  config.php <- importmapの設定がある場所
public/
  js/
    app.js <- アプリケーション全体の管理を想定している。
    services/ <- Javascriptのサービスクラス置き場
  css/
```

## Javascriptモジュールの追加方法

config.phpにimportmapの追記が必要。

## ブラウザキャッシュ対応

更新時にconfig.phpの$filePostfixを変更することで可能。

## 外部ライブラリ

- Vue 3（CDN版）

