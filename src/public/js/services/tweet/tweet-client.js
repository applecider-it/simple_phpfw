import { showToast } from "@/services/ui/message";

/**
 * ツイートクライアント
 */
export default class TweetClient {
  constructor(host, token) {
    this.ws = null;

    this.host = host;
    this.token = token;

    this.ws = new WebSocket(`ws://${this.host}?token=${this.token}`);

    this.ws.onopen = () => console.log("🔗 Connected");
    this.ws.onclose = () => console.log("❌ Disconnected");

    this.ws.onmessage = (e) => this.#handleMessage(e);

    this.addMessage = null;
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

    console.log('handleMessage', data);

    showToast(`新しいツイートがあります。[ ${data.data.content} ]`)
  }
}
