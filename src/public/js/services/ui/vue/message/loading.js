/** ローディングコンポーネント */
const Loading = {
  props: {
    isLoading: {
      type: Boolean,
      required: true,
    },
  },

  template: `
    <div :style="overlayStyle">
      <div :style="spinnerStyle"></div>
    </div>
  `,

  computed: {
    overlayStyle() {
      const style = {
        position: "fixed",
        inset: 0,
        background: "rgba(0,0,0,0.1)",
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        zIndex: 50,
        userSelect: "none",
        transitionProperty: "opacity",
        transitionTimingFunction: "cubic-bezier(0.4, 0, 0.2, 1)",
        transitionDuration: "500ms",
      };

      if (this.isLoading) {
        style.pointerEvents = "auto";
        style.opacity = 1;
      } else {
        style.pointerEvents = "none";
        style.opacity = 0;
      }

      console.log(style);

      return style;
    },

    spinnerStyle() {
      return {
        width: "2.5rem",
        height: "2.5rem",
        border: "2px solid #6b7280",
        borderTopColor: "transparent",
        borderRadius: "50%",
        animation:
          "app-local__js__services__ui__vue__message__loading__loading-spin 0.8s linear infinite",
        boxShadow: "0 0 4px rgba(0,0,0,0.3)",
      };
    },
  },
};

/** スタイルを一度だけ追加 */
(function () {
  const id = "app-local__js__services__ui__vue__message__loading__style";
  if (document.getElementById(id)) return;

  const style = document.createElement("style");
  style.id = id;
  style.textContent = `
    @keyframes app-local__js__services__ui__vue__message__loading__loading-spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
  `;
  document.head.appendChild(style);
})();

export default Loading;
