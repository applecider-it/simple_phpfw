import { showToast, setIsLoading } from "@/services/ui/message";
import Modal from "@/services/ui/vue/popup/modal";

import FormComponent from "@/services/development/vue/frontend_test_area/form_component";

/**
 * フロントエンドテストエリア
 */
const FrontendTestArea = {
  template: `
  <div>
    <div style="display:flex; flex-direction:column; gap:1rem;">
      <div>
        <h3>UIテスト</h3>
        <div style="display:flex; flex-direction:row; gap:1rem;">
          <button type="submit" class="app-btn-primary" @click="() => uiTest('loading')">
            Loading
          </button>

          <button type="submit" class="app-btn-primary" @click="() => uiTest('toast')">
            Toast
          </button>
          
          <button type="submit" class="app-btn-primary" @click="() => uiTest('toastAlert')">
            Toast alert
          </button>
          
          <button type="submit" class="app-btn-primary" @click="() => uiTest('toast2')">
            Toast 2
          </button>
        </div>
      </div>

      <div>
        <h3>ポップアップ</h3>

        <div style="display:flex; flex-direction:row; gap:1rem;">
            <button class="app-btn-primary" @click="open = true">
              Open Modal
            </button>

            <button class="app-btn-secondary" @click="checkModalVal">
              Check Modal
            </button>
        </div>

        <div>
          modalVal: {{ modalVal }}
        </div>
      </div>

      <div>
        <h3>Jsonテスト</h3>
        <div style="display:flex; flex-direction:row; gap:1rem;">
          <button type="submit" class="app-btn-primary" @click="() => jsonTest('postJsonTest')">
            Jsonテスト (POST)
          </button>

          <button type="submit" class="app-btn-primary" @click="() => jsonTest('getJsonTest')">
            Jsonテスト (GET)
          </button>
          
          <button type="submit" class="app-btn-primary" @click="() => jsonTest('postNosessionJsonTest')">
            Jsonテスト (POST nosession)
          </button>
        </div>
      </div>

      <div>
        <h3>フォームテスト</h3>

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

    </div>

    <Modal :isOpen="open" :onClose="closeModal">
      <h2>モーダルタイトル</h2>
      <p>
        <div>
          modalVal: <input
            type="text"
            class="app-form-input"
            style="max-width: 30rem;"
            v-model="modalVal"
          >
        </div>

        <div>
          <button class="app-btn-secondary" @click="closeModal" style="margin-top: 1rem;">
            閉じる
          </button>
        </div>
      </p>
    </Modal>
  </div>
  `,

  components: { FormComponent, Modal },

  props: ["frontendTest"],

  data() {
    return {
      val1: "",
      val2: "",
      open: false,
      modalVal: "",
    };
  },

  methods: {
    /** JSONテスト */
    jsonTest(type) {
      console.log("Test type", type);

      // UIテスト
      if (type === "loading") {
        setIsLoading(true);
        setTimeout(() => {
          setIsLoading(false);
        }, 2000);
      } else if (type === "toast") {
        showToast("トーストテスト");
      } else if (type === "toastAlert") {
        showToast("トーストテスト", "alert");
      } else if (type === "toast2") {
        showToast("トーストテスト");
        showToast("トーストテスト", "alert");
      }
    },

    /** UIテスト */
    uiTest(type) {
      console.log("Test type", type);

      // JSONテスト
      if (type === "postJsonTest") {
        this.frontendTest.postJsonTest();
      } else if (type === "getJsonTest") {
        this.frontendTest.getJsonTest();
      } else if (type === "postNosessionJsonTest") {
        this.frontendTest.postNosessionJsonTest();
      }
    },

    /** モーダルを閉じる */
    closeModal() {
      this.open = false;
    },

    /** モーダルの値を確認 */
    checkModalVal() {
      alert(this.modalVal);
    },
  },
};

export default FrontendTestArea;
