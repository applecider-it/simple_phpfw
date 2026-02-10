/**
 * チャットページのセットアップ
 */

import { createApp } from "@/outer/vue3"

import ChatClient from "@/services/chat/chat-client";
import ChatArea from "@/services/chat/vue/chat-area";

const el = document.getElementById("chat");

if (el) {
  const all = JSON.parse(el.dataset.all);

  console.log('all', all);

  const chatClient = new ChatClient(all.host, all.token);

  createApp(ChatArea, { chatClient }).mount(el);
}
