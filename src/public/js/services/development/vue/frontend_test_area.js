import FormComponent from "@/services/development/vue/frontend_test_area/form_component";

/**
 * フロントエンドテストエリア
 */
const FrontendTestArea = {
  template: `
  <div style="display:flex; flex-direction:column; gap:1rem;">
    <div>
      <h3>Jsonテスト</h3>
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
    </div>

    <div>
      <h3>フォームテスト</h3>

      <div>
        <input
          type="text"
          class="app-form-input"
          style="max-width: 30rem;"
          v-model="val1"
        >
      </div>

      <div>
        val1: {{ val1 }}
      </div>

      <div>
        <FormComponent
          v-model:val1="val1"
          >
        </FormComponent>
      </div>
    </div>
  </div>
  `,

  components: { FormComponent },

  props: ["frontendTest"],

  data() {
    return {
      val1: "",
    };
  },

  methods: {
    /** クリック時 */
    execTest(type) {
      console.log("Test type", type);

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

export default FrontendTestArea;
