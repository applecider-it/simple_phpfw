<h2 class="app-h2">development.javascript_test</h2>
<div>
    <h3 class="app-h3">Json動作確認</h3>

    <div style="display:flex; flex-direction:row; gap:1rem;">
        <button type="submit" class="app-btn-primary" onclick="JavascriptTest.postJsonTest()">
            Jsonテスト (POST)
        </button>

        <button type="submit" class="app-btn-primary" onclick="JavascriptTest.getJsonTest()">
            Jsonテスト (GET)
        </button>

        <button type="submit" class="app-btn-primary" onclick="JavascriptTest.postNosessionJsonTest()">
            Jsonテスト (POST nosession)
        </button>
    </div>
</div>

<script type="module">
    const JavascriptTest = {
        /** POST Jsonの送受信の動作確認 */
        async postJsonTest() {
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

            const url = "/development/api_post?" + app.toQueryString({
                get_val: "Get!!"
            });
            console.log("url", url);

            const result = await app.sendData(method, url, data);

            console.log("result", result);
        },

        /** GET Jsonの送受信の動作確認 */
        async getJsonTest() {
            const method = "GET";

            const url = "/development/api_get?" + app.toQueryString({
                get_val: "Get!!"
            });
            console.log("url", url);

            const result = await app.sendData(method, url);

            console.log("result", result);
        },

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
                "/development/api_post_nosession?" + app.toQueryString({
                    get_val: "Get!!"
                });
            console.log("url", url);

            const result = await this.sendDataNosession(method, url, data);

            console.log("result", result);
        },

        /**
         * セッションのないJsonデータを送受信
         *
         * 動作確認のため、あえて、csrfトークンを除外している送信
         */
        async sendDataNosession(method, uri, data) {
            const prefix = app.getMetaJson("app").prefix;

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
        }
    };

    window.JavascriptTest = JavascriptTest;
</script>