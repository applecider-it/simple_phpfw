# WebSocket

`App\Services\WebSocketCore\WebSocketServer`

PHPでWebSocketサーバーを試作。

NodeのWebSocketサーバーみたいに使えるけど、同期処理なので注意。

## 接続時の時系列図

```
 Client                                Server
   |                                      |
   | --- TCP Connect -------------------> |  (stream_socket_accept で受け付け)
   |                                      |
   | --- WebSocket HTTP Handshake ------> |  (fread でデータ受信)
   |                                      |
   | <--- HTTP 101 Switching Protocols ---|  (fwrite で返す)
   |                                      |
   | === WebSocket通信開始 (Frame形式) === |
```