/**
 * Json関連
 */

/** getパラメーター生成 */
export function toQueryString(params) {
  return new URLSearchParams(params).toString();
}
