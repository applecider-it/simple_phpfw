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
          animation: app-ui-loading-spin 0.8s linear infinite;
          box-shadow: 0 0 4px rgba(0,0,0,0.3);
        "
      ></div>
    </div>
  `,
};

export default Loading;
