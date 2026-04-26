import axios from "axios";
import { getMetaJson } from "@/services/data/html";

/** axiosインスタンス作成 */
const api = axios.create({
    baseURL: getMetaJson("app").prefix,
    headers: {
        "Content-Type": "application/json",
    },
});

/** リクエスト送信 */
export async function sendData(method: string, uri: string, data: any = {}) {
    const isGet = method.toUpperCase() === "GET";

    const res = await api.request({
        url: uri,
        method,
        ...(isGet ? { params: data } : { data }),
        ...(isGet
            ? {}
            : {
                  headers: {
                      "X-CSRF-TOKEN": csrfToken(),
                  },
              }),
    });

    return res.data;
}

/** CSRFトークン取得 */
export function csrfToken() {
    const el = document.querySelector(
        'meta[name="csrf-token"]',
    ) as HTMLMetaElement;

    return el?.content;
}
