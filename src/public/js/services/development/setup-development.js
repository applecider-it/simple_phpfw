/**
 * 開発者向けページのセットアップ
 */

import { createApp } from "@/outer/vue3";

import FrontendTest from "@/services/development/frontend-test";
import FrontendTestArea from "@/services/development/vue/frontend-test-area";

console.log("frontend-test");

const el = document.getElementById("dev");

if (el) {
  const all = JSON.parse(el.dataset.all);

  console.log(all);

  const frontendTest = new FrontendTest();

  createApp(FrontendTestArea, { frontendTest }).mount(el);
}
