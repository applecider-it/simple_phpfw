<?php

use SFW\Exceptions\Trace;

$exceptions = Trace::getExceptions($data['e']);

$isViewException = $data['e'] instanceof SFW\Exceptions\View;

$exception = $exceptions[count($exceptions) - 1];
?>
<?php if ($isViewException): ?>
    <?php
    $meta = $data['e']->meta();
    $srcPath = $meta['srcPath'] ?? null;
    ?>

    <h3>View Exception</h3>
    <div style="margin-bottom: 4rem;">
        <?php if ($srcPath): ?>
            <div><?= $this->h(get_class($exception)) ?>: <?= $this->h($exception->getMessage()) ?> in</div>
            <div><?= $this->h($srcPath) ?> (<?= $exception->getLine() ?>)</div>
            <?= $this->render('errors.partials.lines', [
                'srcPath' => $srcPath,
                'srcLine' => $exception->getLine(),
            ]) ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<h3>Exception</h3>
<div>
    <div><?= $this->h(get_class($exception)) ?>: <?= $this->h($exception->getMessage()) ?> in</div>
    <div><?= $this->h($exception->getFile()) ?> (<?= $exception->getLine() ?>)</div>
    <?= $this->render('errors.partials.lines', [
        'srcPath' => $exception->getFile(),
        'srcLine' => $exception->getLine(),
    ]) ?>
    <pre class="description"><?= $this->h($exception->getTraceAsString()) ?></pre>
</div>

<h3 style="margin-top: 4rem;">All Exceptions</h3>
<div style="display:flex; flex-direction:column; gap:1rem;">
    <?php foreach ($exceptions as $exception): ?>
        <div>
            <div><?= $this->h(get_class($exception)) ?>: <?= $this->h($exception->getMessage()) ?> in</div>
            <div><?= $this->h($exception->getFile()) ?> (<?= $exception->getLine() ?>)</div>
            <pre class="description"><?= $this->h($exception->getTraceAsString()) ?></pre>
        </div>
    <?php endforeach; ?>
</div>