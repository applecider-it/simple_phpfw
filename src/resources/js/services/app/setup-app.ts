import "./bootstrap/alpinejs";

console.log("app start");

// 動作確認
import { getMetaJson } from "@/services/data/html";

console.log("auth user", getMetaJson("user"));
