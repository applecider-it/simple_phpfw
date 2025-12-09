/**
 * 開発者向けページのセットアップ
 */

import { createApp } from "@/outer/vue3"

import FrontendTest from "@/services/development/frontend_test";
import FrontendTestArea from "@/services/development/vue/frontend_test_area";

console.log('frontend_test');


const el = document.getElementById("dev");

if (el) {
  const all = JSON.parse(el.dataset.all);

  console.log(all);

  const frontendTest = new FrontendTest();

  createApp(FrontendTestArea, { frontendTest }).mount(el);
}
