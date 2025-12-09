/**
 * フロントエンドテストエリア
 */
const FrontendTestArea = {
  template: `
  <div style="display:flex; flex-direction:row; gap:1rem;">
    <button type="submit" class="app-btn-primary" @click="() => execTest('postJsonTest')">
      Jsonテスト (POST)
    </button>

    <button type="submit" class="app-btn-primary" @click="() => execTest('getJsonTest')">
      Jsonテスト (GET)
    </button>
    
    <button type="submit" class="app-btn-primary" @click="() => execTest('postNosessionJsonTest')">
      Jsonテスト (POST nosession)
    </button>
  </div>
  `,

  props: ["frontendTest"],

  methods: {
    /** クリック時 */
    execTest(type) {
      console.log('Test type', type)

      if (type === 'postJsonTest') {
        this.frontendTest.postJsonTest();

      } else if (type === 'getJsonTest') {
        this.frontendTest.getJsonTest();

      } else if (type === 'postNosessionJsonTest') {
        this.frontendTest.postNosessionJsonTest();
      }
    },
  },
};

export default FrontendTestArea;