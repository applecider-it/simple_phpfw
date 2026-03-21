<?php

$file = $file ?? $exception->getFile();
$line = $exception->getLine();
?>
<div>
    <div><?= $this->h(get_class($exception)) ?>: <?= $this->h($exception->getMessage()) ?> in</div>
    <div><?= $this->h($file) ?> (<?= $line ?>)</div>
    <?= $this->render('errors.partials.lines', [
        'srcPath' => $file,
        'srcLine' => $line,
    ]) ?>
    <pre class="description"><?= $this->h($exception->getTraceAsString()) ?></pre>
</div>