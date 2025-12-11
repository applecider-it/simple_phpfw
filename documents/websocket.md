# websocket連携

websocketはphpで連携する。

認証はJWTを使う。

## チャンネル名の定義

`channelname:param1,param2...`

## コネクション時のパラメーター

| 項目名 | 内容 | 型 | 詳細 |
|--------|--------|--------|--------|
| token | 認証情報を含むJWTトークン | string |  |

## token

| 項目名 | 内容 | 型 | 詳細 |
|--------|--------|--------|--------|
| id | ID | integer |  |
| name | 表示名 | string |  |
| channel | 接続するチャンネル | string |  |
| iat | 現在日時 | integer |  |
| exp | 有効期限 | integer |  |

## メッセージ送信時

```
{
  data: hash,
}
```

| 項目名 | 内容 | 型 | 詳細 |
|--------|--------|--------|--------|
| data | チャンネルごとの情報ハッシュ | hash |  |

### チャットの場合のdata

```
{
  message: string,
}
```

### ツイートの場合のdata

```
{
  content: string,
}
```

## Redis rpush連携

WebSocketサーバーがPHPのため、Pub/Sub連携は難しいので、rpushを使っている

rpushキー: `websocket_publish`

```
{
  channel: string, <- WebSocketチャンネル名
  data: hash, <- 上記の、「メッセージ送信時」のdataの部分

}
```

## ブロードキャスト時のレスポンス

```
{
  sender: {
    id: number,
    name: string,
  }
  data: hash, <- チャンネルごとに任意
}
```

### チャットの場合のdata

```
{
  message: string,
}
```

### ツイートの場合のdata

```
{
  content: string,
}
```


