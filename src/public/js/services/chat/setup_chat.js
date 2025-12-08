/**
 * チャットページのセットアップ
 */

const { createApp } = Vue;

import ChatClient from "@/services/chat/chat_client";
import ChatArea from "@/services/chat/vue/chat_area";

const el = document.getElementById("chat");

if (el) {
  const all = JSON.parse(el.dataset.all);

  const chatClient = new ChatClient(all.host, all.token);

  createApp(ChatArea, { chatClient }).mount(el);
}
