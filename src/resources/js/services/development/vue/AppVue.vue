<script setup lang="ts">
import { getMetaJson } from "@/services/data/html";
import { sendData } from "@/services/api/rest";

/** POST Jsonの送受信の動作確認 */
const postJsonTest = async () => {
    const method = "POST";
    const data = {
        post_val: "Post!!",
        aaa: {
            bbb: {
                ccc: {
                    ddd: "eee",
                    fff: 1234,
                },
            },
        },
    };

    const url = "/development/api_post?get_val=Get!!";
    console.log("url", url, data);

    const result = await sendData(method, url, data);

    console.log("result", result);
    console.log("result.data", result.data);
};

/** GET Jsonの送受信の動作確認 */
const getJsonTest = async () => {
    const method = "GET";

    const url = "/development/api_get";
    const data = {
        get_val: "Get!!",
    };
    console.log("url", url, data);

    const result = await sendData(method, url, data);

    console.log("result", result);
    console.log("result.data", result.data);
};

/** セッションのないPOST Jsonの送受信の動作確認 */
const postNosessionJsonTest = async () => {
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

    const url = "/development/api_post_nosession?get_val=Get!!";
    console.log("url", url, data);

    const result = await sendDataNosession(method, url, data);

    console.log("result", result);
    console.log("result.data", result.data);
};

/**
 * セッションのないJsonデータを送受信
 *
 * 動作確認のため、あえて、csrfトークンを除外している送信
 */
const sendDataNosession = async (method, uri, data) => {
    const prefix = getMetaJson("app").prefix;

    const params = {
        method: method,
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    };

    const res = await fetch(prefix + uri, params);

    // JSONとして受け取る
    const result = await res.json();

    return result;
};
</script>

<template>
    <div class="space-x-4">
        <button type="button" @click="postJsonTest" class="app-btn-primary">
            Jsonテスト (POST)
        </button>

        <button type="button" @click="getJsonTest" class="app-btn-primary">
            Jsonテスト (GET)
        </button>

        <button
            type="button"
            @click="postNosessionJsonTest"
            class="app-btn-primary"
        >
            Jsonテスト (POST nosession)
        </button>
    </div>
</template>
