export default {
  template: `
    <!-- 送信フォーム -->
    <div style="margin-top: 1rem;">
      <input
        type="text"
        placeholder="メッセージ"
        autofocus
        autocomplete="off"
        class="app-form-input"
        style="max-width: 30rem;"
        @keydown="onKeydown"
        v-model="message"
      >

      <button
        @click="onClick"
        class="app-btn-primary"
        style="margin-top: 0.5rem; margin-left: 1rem;"
        >
        送信
      </button>
    </div>

    <!-- ログ一覧 -->
    <div style="margin-top: 2rem">
      <div v-for="(item, index) in reversedList" :key="index">
        <span>{{ item.data.message }}</span>

        <span style="color:#444; font-size:0.7rem;">
          by {{ item.sender.name }}
        </span>
      </div>
    </div>
  `,

  props: ["chatClient"],

  data() {
    return {
      message: "",
      list: [],
    };
  },

  methods: {
    /** クリック時 */
    onClick() {
      this.send();
    },

    /** inputボックスでキーダウン */
    onKeydown(e) {
      if (e.key === "Enter") this.send();
    },

    /** 送信処理 */
    send() {
      this.chatClient.send(this.message);
      this.message = "";
    },
  },

  computed: {
    /** 逆順のlist */
    reversedList() {
      return [...this.list].reverse();
    },
  },

  /** マウント時 */
  mounted() {
    this.chatClient.setVueObject(this.list);
  },
};
