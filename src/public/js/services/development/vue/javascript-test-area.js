import ModalArea from "@/services/development/vue/javascript-test-area/modal-area";
import VueModelArea from "@/services/development/vue/javascript-test-area/vue-model-area";
import UIArea from "@/services/development/vue/javascript-test-area/ui-area";
import JsonArea from "@/services/development/vue/javascript-test-area/json-area";
import FormArea from "@/services/development/vue/javascript-test-area/form-area";

/**
 * Javascriptテストエリア
 */
const JavascriptTestArea = {
  template: `
  <div>
    <div style="display:flex; flex-direction:column; gap:1rem;">
      <div :style="blockStyle">
        <UIArea />
      </div>

      <div :style="blockStyle">
        <ModalArea />
      </div>

      <div :style="blockStyle">
        <JsonArea :javascriptTest="javascriptTest" />
      </div>

      <div :style="blockStyle">
        <VueModelArea />
      </div>

      <div :style="blockStyle">
        <FormArea
            :propListVal="formData.list_val"
            :propRadioVal="formData.radio_val"
            :propDateTimeVal="formData.datetime_val"
            :listVals="formData.list_vals"
            :radioVals="formData.radio_vals"
        />
      </div>
    </div>
  </div>
  `,

  components: { VueModelArea, ModalArea, UIArea, JsonArea, FormArea },

  props: ["javascriptTest", "formData"],

  data() {
    return {
      blockStyle: "border: 2px solid #444; padding: 1rem;",
    };
  },
};

export default JavascriptTestArea;
