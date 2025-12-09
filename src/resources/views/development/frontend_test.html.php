<?php

use SFW\Core\Config;
use SFW\Output\Html;
?>
<script type="module">
    import "@/services/development/setup_development";
</script>

<h2 class="app-h2">development.frontend_test</h2>
<div>
    <div id="dev"
        data-all="<?= Html::esc(json_encode([
                        'test' => 'test1',
                    ])) ?>">
        <?= $this->render('partials.message.loading') ?>
    </div>
</div>