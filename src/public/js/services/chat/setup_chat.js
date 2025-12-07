/**
 * チャットページのセットアップ
 */

import ChatClient from "@/services/chat/chat_client";

const el = document.getElementById("chat");

if (el) {
  const all = JSON.parse(el.dataset.all);

  new ChatClient(all.host, all.token);
}
