import { vueLocalModel } from "@/services/data/html";

/** フォームテスト */
const FormComponent = {
  template: `
  <div>
    <h4>FormComponent</h4>

    <div>
      <input
        type="text"
        class="app-form-input"
        style="max-width: 30rem;"
        v-model="localVal1"
      >
    </div>

    <div>
      <div>FormComponent: val1: {{ val1 }}</div>
      <div>FormComponent: localVal1: {{ localVal1 }}</div>
    </div>
  </div>
  `,

  props: ["val1"],
  emits: ["update:val1"],

  computed: {
    localVal1: vueLocalModel("val1"),
  },
};

export default FormComponent;
