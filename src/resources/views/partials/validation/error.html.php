<?php

$array = $errors[$attribute] ?? null;
?>
<?php if ($array): ?>
    <div class="mt-2 text-sm text-red-600">
        <?php foreach ($array as $val): ?>
            <div><?= $this->h($val) ?></div>
            <?php break; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>