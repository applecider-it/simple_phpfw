<?php

use SFW\Output\Html;
?>
<h2>development.view_test</h2>
<div>
    <div>$this->data['id'] <?= Html::esc($this->data['id']) ?></div>
    <div>$data['id'] <?= Html::esc($data['id']) ?></div>
    <div>$data['content'] <?= Html::esc($data['content']) ?></div>
    <div>$data['val1'] <?= Html::esc($data['val1'] ?? 'none') ?></div>
    <div>partial test</div>
    <div><?= $this->render('development.partials.view_test_parts', [
        'val1' => '部品用の値',
    ]) ?></div>
</div>
