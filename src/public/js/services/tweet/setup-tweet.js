/**
 * ツイートページのセットアップ
 */

import TweetClient from "@/services/tweet/tweet-client";

const el = document.getElementById("tweet");

if (el) {
  const all = JSON.parse(el.dataset.all);

  const tweetClient = new TweetClient(all.host, all.token);
}
