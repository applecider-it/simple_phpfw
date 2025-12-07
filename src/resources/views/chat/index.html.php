<?php

use SFW\Core\Config;
use SFW\Output\Html;
?>
<script type="module">import "@/services/chat/setup_chat";</script>

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

    <div style="display: none;" id="chat" data-all="<?= Html::esc(json_encode([
        'token' => $data['token'],
    ])) ?>">データ連携用タグ</div>
    
    <div style="margin-top: 2rem;">
        <input
            id="msg" type="text" placeholder="メッセージ"
            autofocus autocomplete="off"
            class="app-form-input" style="width: auto;">
        <button id="sendBtn" class="app-btn-primary">送信</button>
    </div>
    <div id="log" style="margin-top: 2rem"></div>
</div>