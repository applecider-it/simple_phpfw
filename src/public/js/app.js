/**
 * アプリケーション
 */
const app = {
  /** METAタグ内のJSONデータを返す。 */
  getMetaJson(name) {
    const meta = document.querySelector(`meta[name="${name}"]`);

    if (meta) {
      const json = meta.dataset.json;
      const arr = JSON.parse(json);

      return arr;
    }

    return null;
  },

  /** jsonのクローンを生成 */
  clone(original) {
    const clone = JSON.parse(JSON.stringify(original));
    return clone;
  },

  /** getパラメーター生成 */
  toQueryString(params) {
    return new URLSearchParams(params).toString();
  },

  /** Jsonデータを送受信 */
  async sendData(method, uri, argData = {}) {
    const data = this.clone(argData);

    const prefix = this.getMetaJson("app").prefix;

    const params = {
      method: method,
      headers: {
        "Content-Type": "application/json; charset=UTF-8",
      },
    };

    if (method !== "GET") {
      const token = this.csrfToken();

      params.body = JSON.stringify(data);
      params.headers["X-CSRF-TOKEN"] = token;
    }

    const res = await fetch(prefix + uri, params);

    // JSONとして受け取る
    const result = await res.json();

    if (!res.ok) {
      const error = new Error(`http status code: ${res.status}`);
      error.status = res.status;
      error.result = result;

      throw error;
    }

    return result;
  },

  /** CSRFトークンをmetaタグから取得 */
  csrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
  },
};

window.app = app;
