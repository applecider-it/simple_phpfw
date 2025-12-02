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
    document.getElementById("json_test_post").addEventListener("click", () => {
      this.postJsonTest();
    });
    document.getElementById("json_test_get").addEventListener("click", () => {
      this.getJsonTest();
    });
  }

  /** POST Jsonの送受信の動作確認 */
  async postJsonTest() {
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
      "/development/frontend_test_api_post?" + toQueryString({ get_val: "Get!!" });
    console.log("url", url);

    const result = await sendData(method, url, data);

    console.log('result', result);
  }

  /** GET Jsonの送受信の動作確認 */
  async getJsonTest() {
    const method = "GET";

    const url =
      "/development/frontend_test_api_get?" + toQueryString({ get_val: "Get!!" });
    console.log("url", url);

    const result = await sendData(method, url);

    console.log('result', result);
  }
}
