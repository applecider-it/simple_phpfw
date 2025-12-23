import { toQueryString, sendData } from "@/services/data/json";

/**
 * フロントエンドテスト用クラス
 */
export default class FrontendTest {
  constructor() {}

  /** POST Jsonの送受信の動作確認 */
  async postJsonTest() {
    const method = "POST";
    const data = {
      post_val: "Post!!",
      aaa: {
        bbb: {
          ccc: {
            ddd: "eee",
          },
        },
      },
    };

    const url = "/development/api_post?" + toQueryString({ get_val: "Get!!" });
    console.log("url", url);

    const result = await sendData(method, url, data);

    console.log("result", result);
  }

  /** GET Jsonの送受信の動作確認 */
  async getJsonTest() {
    const method = "GET";

    const url = "/development/api_get?" + toQueryString({ get_val: "Get!!" });
    console.log("url", url);

    const result = await sendData(method, url);

    console.log("result", result);
  }

  /** セッションのないPOST Jsonの送受信の動作確認 */
  async postNosessionJsonTest() {
    const method = "POST";
    const data = {
      post_val: "Nosession Post!!",
      aaa: {
        bbb: {
          ccc: {
            ddd: "nosession",
          },
        },
      },
    };

    const url =
      "/development/api_post_nosession?" + toQueryString({ get_val: "Get!!" });
    console.log("url", url);

    const result = await this.sendDataNosession(method, url, data);

    console.log("result", result);
  }

  /**
   * セッションのないJsonデータを送受信
   * 
   * 動作確認のため、あえて、csrfトークンを除外している送信
   */
  async sendDataNosession(method, url, data) {
    const params = {
      method: method,
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    };

    const res = await fetch(url, params);

    // JSONとして受け取る
    const result = await res.json();

    return result;
  }
}
