/**
 * WebSocket チャットクライアント
 */
import { escapeHtml } from "@/services/data/html";

/**
 * チャットクライアント
 */
export default class ChatClient {
  constructor(host, token) {
    this.ws = null;

    this.host = host;
    this.token = token;

    this.logEl = document.getElementById("log");
    this.inputEl = document.getElementById("msg");
    this.sendBtnEl = document.getElementById("sendBtn");

    this.#init();
  }

  /**
   * WebSocket開始・イベント登録
   */
  #init() {
    this.ws = new WebSocket(`ws://${this.host}?token=${this.token}`);

    this.ws.onopen = () => console.log("🔗 Connected");
    this.ws.onclose = () => console.log("❌ Disconnected");

    this.ws.onmessage = (e) => this.#handleMessage(e);

    // 送信イベント
    this.sendBtnEl.addEventListener("click", () => this.#send());
    this.inputEl.addEventListener("keypress", (e) => {
      if (e.key === "Enter") this.#send();
    });
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

    const html = `
      <div>
        <span>${escapeHtml(data.data.message)}</span>
        <span style="color:#444; font-size:0.7rem;">
          by ${escapeHtml(data.sender.name)}
        </span>
      </div>`;

    this.logEl.innerHTML = html + this.logEl.innerHTML;
    this.logEl.scrollTop = this.logEl.scrollHeight;
  }

  /**
   * メッセージ送信
   */
  #send() {
    const message = this.inputEl.value.trim();
    if (!message) return;

    this.ws.send(JSON.stringify({ data: { message } }));

    this.inputEl.value = "";
  }
}
