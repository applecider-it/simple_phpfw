import { vuePropModel } from "@/services/data/html";

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
        v-model="val1"
      >
    </div>

    <div>
      <div>FormComponent: propVal1: {{ propVal1 }}</div>
      <div>FormComponent: val1: {{ val1 }}</div>
    </div>
  </div>
  `,

  props: ["propVal1"],
  emits: ["update:propVal1"],

  computed: {
    val1: vuePropModel("propVal1"),
  },
};

export default FormComponent;
