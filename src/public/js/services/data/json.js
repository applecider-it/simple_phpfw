/**
 * Json関連
 */

/** getパラメーター生成 */
export function toQueryString(params) {
  return new URLSearchParams(params).toString();
}

/** Jsonデータを送受信 */
export async function sendData(method, url, data) {
  const res = await fetch(url, {
    method: method,
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  });

  // JSONとして受け取る
  const result = await res.json();

  return result;
}
