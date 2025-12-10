/**
 * モーダルウィンドウ
 */
const Modal = {
  props: {
    isOpen: Boolean,
    onClose: Function,
  },

  template: `
    <div 
      v-if="isOpen"
      :style="backdropStyle"
      @click="onClose"
    >
      <div 
        :style="contentStyle"
        @click.stop
      >
        <slot></slot>
      </div>
    </div>
  `,

  computed: {
    // 背景のインラインスタイル
    backdropStyle() {
      return {
        position: "fixed",
        top: 0,
        left: 0,
        right: 0,
        bottom: 0,
        background: "rgba(0, 0, 0, 0.5)",
        display: "flex",
        alignItems: "center",
        justifyContent: "center",
        zIndex: 9999,
      };
    },

    // モーダル本体のスタイル
    contentStyle() {
      return {
        background: "#fff",
        padding: "20px",
        borderRadius: "8px",
        maxWidth: "90%",
        maxHeight: "90%",
        overflow: "auto",
      };
    },
  },
};

export default Modal;
