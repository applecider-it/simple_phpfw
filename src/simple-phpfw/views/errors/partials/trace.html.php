<?php
$exception = $data['e'];

$file = $exception->getFile();
$line = $exception->getLine();
?>
<h3>Exception</h3>
<div>
    <div class="trace-exception-info"><?= $this->h(get_class($exception)) ?>: <?= $this->h($exception->getMessage()) ?> in</div>
    <div class="trace-exception-info"><?= $this->h($file) ?> (<?= $line ?>)</div>
    <?= $this->render('errors.partials.lines', [
        'srcPath' => $file,
        'srcLine' => $line,
    ]) ?>
    <pre class="trace-exception-description"><?= $this->h($exception->getTraceAsString()) ?></pre>
</div>