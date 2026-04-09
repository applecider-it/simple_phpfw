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

  const url =
    "/development/api_post?" +
    app.toQueryString({
      get_val: "Get!!",
    });
  console.log("url", url);

  const result = await app.sendData(method, url, data);

  console.log("result", result);
  console.log("result.data", result.data);
};

/** GET Jsonの送受信の動作確認 */
const getJsonTest = async () => {
  const method = "GET";

  const url =
    "/development/api_get?" +
    app.toQueryString({
      get_val: "Get!!",
    });
  console.log("url", url);

  const result = await app.sendData(method, url);

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

  const url =
    "/development/api_post_nosession?" +
    app.toQueryString({
      get_val: "Get!!",
    });
  console.log("url", url);

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
};

window.handle = {
  postJsonTest,
  getJsonTest,
  postNosessionJsonTest,
};
