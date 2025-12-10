/**
 * ログインユーザーを返す。 
 */
export function getAuthUser() {
  const meta = document.querySelector('meta[name="user"]');

  if (meta) {
      const json = meta.dataset.json;
      const arr = JSON.parse(json);

      return arr;
  }

  return null;
}