/**
 * ツイートページのセットアップ
 */

import { createApp } from "@/outer/vue3"

import TweetClient from "@/services/tweet/tweet-client";
import TweetArea from "@/services/tweet/vue/tweet-area";

const el = document.getElementById("tweet");

if (el) {
  const all = JSON.parse(el.dataset.all);

  console.log('all', all);

  const tweetClient = new TweetClient(all.host, all.token);

  createApp(TweetArea, { tweetClient, tweets: all.tweets }).mount(el);
}
