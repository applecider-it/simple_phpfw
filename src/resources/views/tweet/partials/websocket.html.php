<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<script type="module">
    import "@/services/tweet/setup_tweet";
</script>

<div id="tweet"
    data-all="<?= Html::esc(json_encode([
                    'token' => $data['token'],
                    'host' => Config::get('ws_server_host'),
                ])) ?>">
</div>