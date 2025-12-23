<?php

use SFW\Core\Config;
use SFW\Output\Html;
?>
<script type="module">
    import "@/services/development/setup-development";
</script>

<h2 class="app-h2">development.frontend_test</h2>
<div>
    <div id="dev"
        data-all="<?= Html::esc(json_encode([
                        'test' => 'test1',
                    ])) ?>">
        <?= $this->render('partials.message.loading') ?>
    </div>

    <div>
        <h3>読み込み中表示の動作確認</h3>
        <div style="border: 1px solid #555; padding: 0;">
            <?= $this->render('partials.message.loading') ?>
        </div>
    </div>
</div>