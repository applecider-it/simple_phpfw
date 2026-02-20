/**
 * 開発者向けページのセットアップ
 */

import { createApp } from "@/outer/vue3";

import JavascriptTest from "@/services/development/javascript-test";
import JavascriptTestArea from "@/services/development/vue/javascript-test-area";

console.log("javascript-test");

const el = document.getElementById("dev");

if (el) {
  const all = JSON.parse(el.dataset.all);

  console.log(all);

  const javascriptTest = new JavascriptTest();

  createApp(JavascriptTestArea, {
    javascriptTest,
    formData: all.formData,
  }).mount(el);
}
