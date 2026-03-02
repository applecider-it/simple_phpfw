/**
 * Json動作確認
 */
const JsonArea = {
  props: ["javascriptTest"],

  methods: {
    /** JSONテスト */
    jsonTest(type) {
      console.log("Test type", type);

      // JSONテスト
      if (type === "postJsonTest") {
        this.javascriptTest.postJsonTest();
      } else if (type === "getJsonTest") {
        this.javascriptTest.getJsonTest();
      } else if (type === "postNosessionJsonTest") {
        this.javascriptTest.postNosessionJsonTest();
      }
    },
  },

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
};

export default JsonArea;
