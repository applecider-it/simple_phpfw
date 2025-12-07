/**
 * チャットページのセットアップ
 */

const el = document.getElementById("chat");

if (el) {
  const all = JSON.parse(el.dataset.all);

  console.log(all);

  const ws = new WebSocket("ws://127.0.0.1:8080?token=" + all.token);
  const log = document.getElementById("log");

  ws.onmessage = (e) => {
    log.innerHTML = `<div>${e.data}</div>` + log.innerHTML;
    log.scrollTop = log.scrollHeight;
  };

  function send() {
    const m = document.getElementById("msg");
    ws.send(m.value);
    m.value = "";
  }

  document.getElementById("msg").addEventListener("keypress", (e) => {
    if (e.key === "Enter") send();
  });
  document.getElementById("sendBtn").addEventListener("click", (e) => {
    send();
  });
}
