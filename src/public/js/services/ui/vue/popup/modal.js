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
      const style = {
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
        transitionProperty: "opacity",
        transitionTimingFunction: "cubic-bezier(0.4, 0, 1, 1)",
        transitionDuration: "500ms",
      };

      if (this.isOpen) {
        style.pointerEvents = "auto";
        style.opacity = 1;
      } else {
        style.pointerEvents = "none";
        style.opacity = 0;
      }

      return style;
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
