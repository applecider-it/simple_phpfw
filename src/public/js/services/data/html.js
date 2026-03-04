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
export function vuePropModel(key) {
  return {
    get() {
      return this[key];
    },
    set(value) {
      this.$emit("update:" + key, value);
    },
  };
}

/**
 * METAタグ内のJSONデータを返す。
 */
export function getMetaJson(name) {
  const meta = document.querySelector(`meta[name="${name}"]`);

  if (meta) {
    const json = meta.dataset.json;
    const arr = JSON.parse(json);

    return arr;
  }

  return null;
}
