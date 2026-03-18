import { clone } from "@/services/data/json";
import { getMetaJson } from "@/services/data/html";

/**
 * REST関連
 */

/** getパラメーター生成 */
export function toQueryString(params) {
  return new URLSearchParams(params).toString();
}

/** Jsonデータを送受信 */
export async function sendData(method, uri, argData = {}) {
  const data = clone(argData);

  const prefix = getMetaJson('app').prefix;

  const params = {
    method: method,
    headers: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  };

  if (method !== "GET") {
    const token = csrfToken();

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
}

/** CSRFトークンをmetaタグから取得 */
function csrfToken() {
  return document.querySelector('meta[name="csrf-token"]').content;
}
