/** トーストリストコンポーネント */
const Toasts = {
  props: ["toasts"],

  methods: {
    boxStyle(toast) {
      const bg = toast.type === "alert" ? "#fecaca" : "#bfdbfe"; // red-200 / blue-200
      return {
        fontSize: "0.875rem",
        backgroundColor: bg,
        border: "2px solid #9ca3af",
        color: "black",
        padding: "0.25rem 0.75rem",
        borderRadius: "0.5rem",
        boxShadow: "0 2px 6px rgba(0,0,0,0.2)",
        animation: "app-local__js__services__ui__vue__message__toast__slide-in 0.3s ease-out",
      };
    },

    wrapperStyle() {
      return {
        position: "fixed",
        top: "1rem",
        right: "1rem",
        zIndex: 50,
        display: "flex",
        flexDirection: "column",
        gap: "0.5rem",
      };
    },
  },

  template: `
    <div :style="wrapperStyle()">
      <div
        v-for="toast in toasts"
        :key="toast.id"
        :style="boxStyle(toast)"
      >
        {{ toast.message }}
      </div>
    </div>
  `,
};

/** スタイルを一度だけ追加 */
(function () {
  const id = "app-local__js__services__ui__vue__message__toast__style";
  if (document.getElementById(id)) return;

  const style = document.createElement("style");
  style.id = id;
  style.textContent = `
    @keyframes app-local__js__services__ui__vue__message__toast__slide-in {
      from {
        opacity: 0;
        transform: translateX(20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
  `;
  document.head.appendChild(style);
})();

export default Toasts;
