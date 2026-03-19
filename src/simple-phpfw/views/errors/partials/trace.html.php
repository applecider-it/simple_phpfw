<?php
$getRootPrevious = function ($e) {
    while ($e->getPrevious() !== null) {
        $e = $e->getPrevious();
    }
    return $e;
}
?>
<?php if ($data['e'] instanceof SFW\Exceptions\View): ?>
    <?php $meta = $data['e']->meta(); ?>
    <?php $srcPath = $meta['srcPath'] ?? null; ?>
    <?php $rootPrevious = $getRootPrevious($data['e']); ?>

    <h3>View Error</h3>
    <div>
        <?php if ($srcPath): ?>
            <div>Source: <?= $this->h($srcPath) ?></div>
            <div style="margin-top: 0.5rem;">Exception:</div>
            <div><?= $this->h(get_class($rootPrevious)) ?>: <?= $this->h($rootPrevious->getMessage()) ?> in</div>
            <div><?= $this->h($rootPrevious->getFile()) ?> (<?= $rootPrevious->getLine() ?>)</div>
        <?php endif; ?>
        <pre class="description"><?= $this->h($rootPrevious) ?></pre>
    </div>

    <h3>All Errors</h3>
    <div>
        <pre class="description"><?= $this->h($data['e']) ?></pre>
    </div>
<?php else: ?>
    <pre class="description"><?= $this->h($data['e']) ?></pre>
<?php endif; ?>