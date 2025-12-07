<?php

use SFW\Core\Config;
use SFW\Output\Html;
?>
<script type="module">
    import "@/services/chat/setup_chat";
</script>

<div style="display: none;" id="chat"
    data-all="<?= Html::esc(json_encode([
                    'token' => $data['token'],
                    'host' => '127.0.0.1:9090',
                ])) ?>">データ連携用タグ</div>

<h2 class="app-h2">
    chat.index
    <?php if ($data['room']): ?>
        room: <?= $data['room'] ?>
    <?php endif; ?>
</h2>

<div>
    <div style="margin: 1rem 0; display:flex; flex-direction:row; gap:1rem;">
        <?php foreach ($data['rooms'] as $r): ?>
            <a href="/chat?room=<?= $r ?>" class="app-link-normal"><?= $r ? $r : 'default' ?></a>
        <?php endforeach; ?>
    </div>

    <style>
        #log {
            height: 300px;
            border: 1px solid #aaa;
            overflow-y: scroll;
            padding: 5px;
        }
    </style>

    <div style="margin-top: 1rem;">
        <input
            id="msg" type="text" placeholder="メッセージ"
            autofocus autocomplete="off"
            class="app-form-input" style="max-width: 30rem;">
        <button id="sendBtn" class="app-btn-primary" style="margin-top: 0.5rem;">送信</button>
    </div>
    <div id="log" style="margin-top: 2rem"></div>
</div>