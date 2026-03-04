import { getMetaJson } from "@/services/data/html";

/**
 * ログインユーザーを返す。 
 */
export function getAuthUser() {
  return getMetaJson('user');
}