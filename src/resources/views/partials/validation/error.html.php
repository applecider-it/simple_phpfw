<?php

$array = $errors[$attribute] ?? null;
?>
<?php if ($array): ?>
    <div style="margin:0.5rem 0; color: #c0392b; font-size: 0.8rem;">
        <?php foreach ($array as $val): ?>
            <div><?= $this->h($val) ?></div>
            <?php break; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>