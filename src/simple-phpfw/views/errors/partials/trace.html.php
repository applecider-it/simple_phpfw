<?php

use SFW\Data\Exception;

$exceptions = Exception::getExceptions($data['e']);

//$exceptions = [...$exceptions, ...$exceptions];   // 動作確認用
?>
<h3>Exceptions</h3>
<div style="display:flex; flex-direction:column; gap:1rem;">
    <?php foreach ($exceptions as $exception): ?>
        <?= $this->render('errors.partials.exception', [
            'exception' => $exception,
        ]) ?>
    <?php endforeach; ?>
</div>