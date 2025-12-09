/**
 * HTML関連
 */

/** HTMLエスケープ */
export function escapeHtml(str) {
    str = String(str);
    return str
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

/** (vueの補助機能) 別コンポーネントでv-modelを使えるようにする */
export function vueLocalModel(key) {
  return {
    get() {
      return this[key];
    },
    set(value) {
      this.$emit("update:" + key, value);
    },
  };
}
