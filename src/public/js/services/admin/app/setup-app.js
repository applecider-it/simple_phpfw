/**
 * 管理画面のセットアップ
 */

import "@/services/app/bootstrap/container";

console.log("init admin");

// 動作確認
import { showToast, setIsLoading } from "@/services/ui/message";

// 動作確認
import { getAuthAdminUser } from "@/services/admin/app/application";

console.log("getAuthAdminUser", getAuthAdminUser());

/*
setTimeout(() => {
  showToast('Test');
  setIsLoading(true);
}, 1000);
 */
