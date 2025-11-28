<?php

use SFW\Output\Html;

$array = $data['errors'][$data['attribute']] ?? null;
?>
<?php if ($array): ?>
    <ul style="margin-top:0.5rem; padding-left: 1.2rem; color: #c0392b;">
        <?php foreach ($array as $val): ?>
            <li><?= Html::esc($val) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>