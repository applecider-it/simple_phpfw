<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2 class="app-h2">tweet_js.index</h2>

<script type="module">
    import "@/services/tweet/setup-tweet";
</script>

<div id="tweet"
    data-all="<?= Html::esc(json_encode([
                    'token' => $token,
                    'host' => Config::get('app.ws_server_host'),
                ])) ?>">
    <?= $this->render('partials.message.loading') ?>
</div>