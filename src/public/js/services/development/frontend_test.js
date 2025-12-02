import { toQueryString } from "@/services/data/json";

/**
 * フロントエンドテスト用クラス
 */
export default class FrontendTest {
  constructor() {
    this.setupEvent();
  }

  /** イベント設定 */
  setupEvent() {
    document.getElementById("json_test").addEventListener("click", () => {
      this.jsonTest();
    });
  }

  /** Jsonの送受信の動作確認 */
  jsonTest() {
    async function sendData() {
      const method = "POST";
      const data = {
        post_val: "Post!!",
      };

      const url =
        "/development/frontend_test_api?" + toQueryString({ get_val: "Get!!" });
      console.log("url", url);

      const res = await fetch(url, {
        method: method,
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      // JSONとして受け取る
      const json = await res.json();
      console.log(json);
    }

    sendData();
  }
}
