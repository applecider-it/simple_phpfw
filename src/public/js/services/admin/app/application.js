import { getMetaJson } from "@/services/data/html";

/**
 * ログイン中の管理者を返す。 
 */
export function getAuthAdminUser() {
  return getMetaJson('admin-user');
}