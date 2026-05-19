import axios from "axios";
import type { AxiosRequestConfig } from "axios";

import { getMetaJson } from "@/services/data/html";

/** axiosインスタンス作成 */
const api = axios.create({
    baseURL: getMetaJson("app").prefix,
    headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
    },
});

/** リクエスト送信 */
export async function sendData<T>(
    method: string,
    uri: string,
    data: Record<string, unknown> = {},
): Promise<T> {
    const isGet = method.toUpperCase() === "GET";

    const config: AxiosRequestConfig = {
        url: uri,
        method,
    };

    if (isGet) {
        config.params = data;
    } else {
        config.data = data;
        config.headers = {
            "X-CSRF-TOKEN": csrfToken(),
        };
    }

    console.log('sendData', {config})

    const res = await api.request<T>(config);

    return res.data;
}

/** CSRFトークン取得 */
export function csrfToken() {
    const el = document.querySelector(
        'meta[name="csrf-token"]',
    ) as HTMLMetaElement;

    return el?.content;
}
