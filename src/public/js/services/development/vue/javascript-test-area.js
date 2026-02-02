import ModalArea from "@/services/development/vue/javascript-test-area/modal-area";
import VueModelArea from "@/services/development/vue/javascript-test-area/vue-model-area";
import UIArea from "@/services/development/vue/javascript-test-area/ui-area";
import JsonArea from "@/services/development/vue/javascript-test-area/json-area";

/**
 * Javascriptテストエリア
 */
const JavascriptTestArea = {
  template: `
  <div>
    <div style="display:flex; flex-direction:column; gap:1rem;">
      <div>
        <UIArea />
      </div>

      <div>
        <ModalArea />
      </div>

      <div>
        <JsonArea :javascriptTest="javascriptTest" />
      </div>

      <div>
        <VueModelArea />
      </div>
    </div>
  </div>
  `,

  components: { VueModelArea, ModalArea, UIArea, JsonArea },

  props: ["javascriptTest"],
};

export default JavascriptTestArea;
