/** ローディングコンポーネント */
const Loading = {
  props: {
    isLoading: {
      type: Boolean,
      required: true,
    },
  },

  template: `
    <div v-if="isLoading"
         style="
           position: fixed;
           inset: 0;
           background: rgba(0,0,0,0.1);
           display: flex;
           justify-content: center;
           align-items: center;
           z-index: 50;
           user-select: none;
         "
    >
      <div
        style="
          width: 2.5rem;
          height: 2.5rem;
          border: 2px solid #6b7280;
          border-top-color: transparent;
          border-radius: 50%;
          animation: app-local__js__services__ui__vue__message__loading__loading-spin 0.8s linear infinite;
          box-shadow: 0 0 4px rgba(0,0,0,0.3);
        "
      ></div>
    </div>
  `,
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
