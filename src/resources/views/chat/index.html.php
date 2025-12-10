<?php

use SFW\Core\Config;
use SFW\Output\Html;
?>
<script type="module">
    import "@/services/chat/setup_chat";
</script>

<style>
    .chat-log {
        height: 300px;
        border: 1px solid #aaa;
        overflow-y: scroll;
        padding: 5px;
    }
</style>

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

    <div id="chat"
        data-all="<?= Html::esc(json_encode([
                        'token' => $data['token'],
                        'host' => Config::get('ws_server_host'),
                    ])) ?>">
        <?= $this->render('partials.message.loading') ?>
    </div>

</div>