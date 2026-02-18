/**
 * 管理画面のセットアップ
 */

import { createApp } from "@/outer/vue3";

import AppCommon from "@/services/app/vue/app-common";
import { getAuthUser } from "@/services/app/application";

/** 共通コンテナをセットアップする */
function setupContainerCommon() {
  const el = document.getElementById("app-container-common");
  if (el) {
    createApp(AppCommon).mount(el);
  }
}

setupContainerCommon();

console.log("getAuthAdminUser", getAuthUser());

/*
// UI動作確認
import { showToast, setIsLoading } from "@/services/ui/message";

setTimeout(() => {
  showToast('Test');
  setIsLoading(true);
}, 1000);
 */
