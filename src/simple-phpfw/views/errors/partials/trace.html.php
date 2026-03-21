<?php

use SFW\Data\Exception;
use SFW\Data\Path;

// 通常は１つだけど、Viewで例外が発生したときは複数になる
$exceptions = Exception::getExceptions($data['e']);

/** @var bool Viewで発生した例外の場合はtrue */
$isViewException = $data['e'] instanceof SFW\Exceptions\View;

$exception = $exceptions[count($exceptions) - 1];
?>
<?php if ($isViewException): ?>
    <?php /* Viewで発生した例外の場合 */ ?>
    <?php
    $meta = $data['e']->meta();
    $srcPath = $meta['srcPath'] ?? null;

    /** @var bool Viewのテンポラリーファイル内で発生した例外の場合はtrue */
    $errorInTemporary = Path::isViewTemporaryPath($exception->getFile());
    ?>

    <h3>View Exception</h3>
    <div style="margin-bottom: 4rem;">
        <?php if ($srcPath): ?>
            <?php /* ソースがある場合 */ ?>
            <?php if ($errorInTemporary): ?>
                <?php /* テンポラリーファイル内で発生した例外の場合 */ ?>
                <div><?= $this->h(get_class($exception)) ?>: <?= $this->h($exception->getMessage()) ?> in</div>
                <div><?= $this->h($srcPath) ?> (<?= $exception->getLine() ?>)</div>
                <?= $this->render('errors.partials.lines', [
                    'srcPath' => $srcPath,
                    'srcLine' => $exception->getLine(), // ソースとテンポラリーファイルは同じ行になる
                ]) ?>
            <?php else: ?>
                <?php /* テンポラリーファイル外で発生した例外の場合 */ ?>
                <div><?= $this->h($srcPath) ?></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<h3>Exception</h3>
<?= $this->render('errors.partials.exception', [
    'exception' => $exception,
]) ?>

<?= $this->render('errors.partials.all', [
    'exceptions' => $exceptions,
]) ?>