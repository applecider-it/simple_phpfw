<h2 class="app-h2">chat.index</h2>
<div>
    <style>
        #log {
            height: 300px;
            border: 1px solid #aaa;
            overflow-y: scroll;
            padding: 5px;
        }
    </style>
    <div id="log"></div>
    <div style="margin-top: 2rem;">
    <input id="msg" type="text" placeholder="メッセージ" autofocus class="app-form-input" style="width: auto;">
    <button onclick="send()" class="app-btn-primary">送信</button>

    </div>

    <script>
        let ws = new WebSocket("ws://127.0.0.1:8080");
        let log = document.getElementById("log");

        ws.onmessage = (e) => {
            log.innerHTML += `<div>${e.data}</div>`;
            log.scrollTop = log.scrollHeight;
        };

        function send() {
            let m = document.getElementById("msg");
            ws.send(m.value);
            m.value = "";
        }
        document.getElementById("msg").addEventListener("keypress", e => {
            if (e.key === "Enter") send();
        });
    </script>
</div>