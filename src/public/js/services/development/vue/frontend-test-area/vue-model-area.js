import FormComponent from "@/services/development/vue/frontend-test-area/vue-model-area/form-component";

/**
 * Vueモデル動作確認
 */
const VueModelArea = {
  template: `
  <div>
    <h3>Vueモデル動作確認</h3>

    <div>
      val1: <input
        type="text"
        class="app-form-input"
        style="max-width: 30rem;"
        v-model="val1"
      >
    </div>
    <div>
      val2: <input
        type="text"
        class="app-form-input"
        style="max-width: 30rem;"
        v-model="val2"
      >
    </div>

    <div>
      val1: {{ val1 }}
    </div>
    <div>
      val2: {{ val2 }}
    </div>

    <h3>別コンポーネントとのv-modelの連携の動作確認</h3>

    <div>
      <FormComponent
        v-model:propVal1="val1"
        v-model:propVal2="val2"
        >
      </FormComponent>
    </div>
  </div>
  `,

  components: { FormComponent },

  data() {
    return {
      val1: "",
      val2: "",
    };
  },
};

export default VueModelArea;
