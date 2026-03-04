import { createApp } from "@/outer/vue3";

import AppCommon from "@/services/app/vue/app-common";

/** 共通コンテナをセットアップする */
function setupContainerCommon() {
  const el = document.getElementById("app-container-common");
  if (el) {
    createApp(AppCommon).mount(el);
  }
}

setupContainerCommon();
