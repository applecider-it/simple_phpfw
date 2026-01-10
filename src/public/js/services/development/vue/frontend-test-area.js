import ModalArea from "@/services/development/vue/frontend-test-area/modal-area";
import VueModelArea from "@/services/development/vue/frontend-test-area/vue-model-area";
import UIArea from "@/services/development/vue/frontend-test-area/ui-area";
import JsonArea from "@/services/development/vue/frontend-test-area/json-area";

/**
 * フロントエンドテストエリア
 */
const FrontendTestArea = {
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
        <JsonArea :frontendTest="frontendTest" />
      </div>

      <div>
        <VueModelArea />
      </div>
    </div>
  </div>
  `,

  components: { VueModelArea, ModalArea, UIArea, JsonArea },

  props: ["frontendTest"],
};

export default FrontendTestArea;
