/**
 * Json動作確認
 */
const JsonArea = {
  template: `
  <div>
    <h3>Json動作確認</h3>

    <div style="display:flex; flex-direction:row; gap:1rem;">
      <button type="submit" class="app-btn-primary" @click="() => jsonTest('postJsonTest')">
        Jsonテスト (POST)
      </button>

      <button type="submit" class="app-btn-primary" @click="() => jsonTest('getJsonTest')">
        Jsonテスト (GET)
      </button>
      
      <button type="submit" class="app-btn-primary" @click="() => jsonTest('postNosessionJsonTest')">
        Jsonテスト (POST nosession)
      </button>
    </div>
  </div>
  `,

  props: ["frontendTest"],

  methods: {
    /** JSONテスト */
    jsonTest(type) {
      console.log("Test type", type);

      // JSONテスト
      if (type === "postJsonTest") {
        this.frontendTest.postJsonTest();
      } else if (type === "getJsonTest") {
        this.frontendTest.getJsonTest();
      } else if (type === "postNosessionJsonTest") {
        this.frontendTest.postNosessionJsonTest();
      }
    },
  },
};

export default JsonArea;
