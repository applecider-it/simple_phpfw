<?php

use SFW\Core\Config;
use SFW\Output\Html;
?>
<script type="module">
    import "@/services/development/setup-development";
</script>

<h2 class="app-h2">development.javascript_test</h2>
<div>
    <div id="dev"
        data-all="<?= Html::esc(json_encode([
                        'test' => 'test1',
                        'formData' => $data['formData'],
                    ])) ?>">
        <?= $this->render('partials.message.loading') ?>
    </div>
</div>