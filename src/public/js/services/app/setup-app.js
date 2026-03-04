/**
 * アプリケーションのセットアップ
 */

import "@/services/app/bootstrap/container";
import "@/services/app/bootstrap/menu";

console.log("init app");

// 動作確認
import { getAuthUser } from "@/services/app/application";

console.log("getAuthUser", getAuthUser());
