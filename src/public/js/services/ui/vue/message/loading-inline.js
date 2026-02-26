const idPrefix = "app-local__js__services__ui__vue__message__loading-inline";

/** インラインローディングコンポーネント */
const LoadingInline = {
  template: `
    <div :style="loaderStyle">
      <span :style="dotStyle"></span>
      <span :style="dotStyleDelay1"></span>
      <span :style="dotStyleDelay2"></span>
    </div>
  `,

  data() {
    return {
      dotStyleBase: {
        width: "12px",
        height: "12px",
        backgroundColor: "#6b7280",
        borderRadius: "9999px",
        animation:
          idPrefix + "__bounce 1s infinite",
      },
    };
  },

  computed: {
    loaderStyle() {
      return {
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        gap: "8px",
        margin: "7rem 0",
        opacity: 0,
        animation:
          idPrefix + "__fadeInAccel 3s cubic-bezier(0.16, 1, 0.3, 1) forwards",
      };
    },

    dotStyle() {
      return this.dotStyleBase;
    },

    dotStyleDelay1() {
      return {
        ...this.dotStyleBase,
        animationDelay: "-0.2s",
      };
    },

    dotStyleDelay2() {
      return {
        ...this.dotStyleBase,
        animationDelay: "-0.4s",
      };
    },
  },
};

/** スタイルを一度だけ追加 */
(function () {
  const id = idPrefix + "__style";
  if (document.getElementById(id)) return;

  const style = document.createElement("style");
  style.id = id;
  style.textContent = `
    /* Tailwindのanimate-bounce相当 */
    @keyframes ${idPrefix}__bounce {
        0%, 100% {
            transform: translateY(-25%);
            animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
        }
        50% {
            transform: translateY(0);
            animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
        }
    }

    /* フェードイン */
    @keyframes ${idPrefix}__fadeInAccel {
        0% {
            opacity: 0;
            transform: scale(0.5);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
  `;
  document.head.appendChild(style);
})();

export default LoadingInline;
