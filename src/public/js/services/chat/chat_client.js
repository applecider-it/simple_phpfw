/**
 * チャットクライアント
 */
export default class ChatClient {
  constructor(host, token) {
    this.ws = null;

    this.host = host;
    this.token = token;

    this.ws = new WebSocket(`ws://${this.host}?token=${this.token}`);

    this.ws.onopen = () => console.log("🔗 Connected");
    this.ws.onclose = () => console.log("❌ Disconnected");

    this.ws.onmessage = (e) => this.#handleMessage(e);
  }

  /**
   * vueオブジェクトを設定
   */
  setVueObject(list) {
    this.list = list;
  }

  /**
   * 受信処理
   */
  #handleMessage(e) {
    let data;
    try {
      data = JSON.parse(e.data);
    } catch {
      console.warn("Wrong JSON:", e.data);
      return;
    }

    this.list.push(data);
  }

  /**
   * メッセージ送信
   */
  send(message) {
    if (!message) return;

    this.ws.send(JSON.stringify({ data: { message } }));
  }
}
