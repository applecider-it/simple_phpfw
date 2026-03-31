import JsonArea from "@/services/development/vue/javascript-test-area/json-area";

/**
 * Javascriptテストエリア
 */
const JavascriptTestArea = {
  components: { JsonArea },

  props: ["javascriptTest", "formData"],

  data() {
    return {
      blockStyle: "border: 2px solid #444; padding: 1rem;",
    };
  },

  template: `
  <div>
    <div style="display:flex; flex-direction:column; gap:1rem;">
      <div :style="blockStyle">
        <JsonArea :javascriptTest="javascriptTest" />
      </div>
    </div>
  </div>
  `,
};

export default JavascriptTestArea;
