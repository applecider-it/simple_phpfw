<?php

use SFW\Core\Config;
use function SFW\Helpers\route;
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
    ( room: {{ $rooms[$room] }} )
</h2>

<div>
    <div style="margin: 1rem 0; display:flex; flex-direction:row; gap:1rem;">
        <?php foreach ($rooms as $key => $val): ?>
            <?php if ($key === $room): ?>
                <span>{{ $val }}</span>
            <?php else: ?>
                <a href="{{ route('chat.index') . '?room=' . $key }}" class="app-link-normal">{{ $val }}</a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div id="chat"
        data-all="{{ json_encode([
                        'token' => $token,
                        'room' => $room,
                        'host' => Config::get('app.ws_server_host'),
                    ]) }}">
        <?= $this->render('partials.message.loading') ?>
    </div>

</div>