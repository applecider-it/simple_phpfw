/**
 * アプリケーションのセットアップ
 */

import { createApp } from "@/outer/vue3"

import AppCommon from "@/services/app/vue/app_common";
import { getAuthUser } from "@/services/app/application";

const el = document.getElementById("app-container-common");
if (el) {
  createApp(AppCommon).mount(el);
}

/** メニューをセットアップする */
function setupMenu() {
  const btn = document.getElementById("app-nav-mobile-menu-button");
  const area = document.getElementById("app-nav-mobile-menu-area");

  if (btn && area) {
    btn.addEventListener("click", () => {
      area.classList.toggle("app-layout-nav-responsive-links__open");
    });
  }
}

setupMenu();

console.log('getAuthUser', getAuthUser());
