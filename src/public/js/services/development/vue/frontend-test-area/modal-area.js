import Modal from "@/services/ui/vue/popup/modal";

/**
 * モーダル動作確認
 */
const ModalArea = {
  template: `
  <div>
    <div>
      <h3>モーダル動作確認</h3>

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

  components: { Modal },

  data() {
    return {
      open: false,
      modalVal: "",
    };
  },

  methods: {
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

export default ModalArea;
