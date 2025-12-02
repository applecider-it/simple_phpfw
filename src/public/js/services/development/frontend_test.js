import { toQueryString, sendData } from "@/services/data/json";

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
  async jsonTest() {
    const method = "POST";
    const data = {
      post_val: "Post!!",
      aaa: {
        bbb: {
          ccc: {
            ddd: 'eee',
          }
        }
      }
    };

    const url =
      "/development/frontend_test_api?" + toQueryString({ get_val: "Get!!" });
    console.log("url", url);

    const result = await sendData(method, url, data);

    console.log('result', result);
  }
}
