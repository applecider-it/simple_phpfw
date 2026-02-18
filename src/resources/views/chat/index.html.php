<?php

use SFW\Core\Config;
use function SFW\Helpers\html_esc as h;

$room = $data['room'];
$rooms = $data['rooms'];
?>
<script type="module">
    import "@/services/chat/setup-chat";
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
    ( room: <?= h($rooms[$room]) ?> )
</h2>

<div>
    <div style="margin: 1rem 0; display:flex; flex-direction:row; gap:1rem;">
        <?php foreach ($rooms as $key => $val): ?>
            <?php if ($key === $room): ?>
                <span><?= h($val) ?></span>
            <?php else: ?>
                <a href="/chat?room=<?= h($key) ?>" class="app-link-normal"><?= h($val) ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div id="chat"
        data-all="<?= h(json_encode([
                        'token' => $data['token'],
                        'room' => $data['room'],
                        'host' => Config::get('ws_server_host'),
                    ])) ?>">
        <?= $this->render('partials.message.loading') ?>
    </div>

</div>