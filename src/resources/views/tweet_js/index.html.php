<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2 class="app-h2">tweet_js.index</h2>

<div>
    受信のみ実装しています。
</div>

<script type="module">
    import "@/services/tweet/setup-tweet";
</script>

<div id="tweet"
    data-all="<?= Html::esc(json_encode([
                    'token' => $data['token'],
                    'host' => Config::get('myapp.ws_server_host'),
                ])) ?>">
</div>