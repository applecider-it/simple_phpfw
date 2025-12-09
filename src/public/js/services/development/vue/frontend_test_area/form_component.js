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

    <div style="margin-top: 1rem">
      <div>FormComponent: propVal1: {{ propVal1 }}</div>
      <div>FormComponent: val1: {{ val1 }}</div>
    </div>

    <div style="margin-top: 1rem">
      <div style="display:flex; flex-direction:row; gap:1rem;">
        <button type="submit" class="app-btn-primary" @click="() => execTest('addText')">
          文字追加
        </button>
      </div>
    </div>
  </div>
  `,

  props: ["propVal1"],
  emits: ["update:propVal1"],

  computed: {
    val1: vuePropModel("propVal1"),
  },

  methods: {
    /** クリック時 */
    execTest(type) {
      console.log("Test type", type);

      if (type === "addText") {
        this.val1 += "[add text]";
      }
    },
  },
};

export default FormComponent;
