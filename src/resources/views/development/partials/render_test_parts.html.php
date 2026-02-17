<?php

use SFW\Output\Html;

$metaStyle = $data['metaStyle'];
?>
<h3 class="app-h3" style="margin-top: 1rem;">development.partials.render_test_parts</h3>

<div style="<?= $metaStyle ?>">
    <div>$name <?= Html::esc($name) ?></div>
    <div>$baseDir <?= Html::esc($baseDir) ?></div>
    <div>$path <?= Html::esc($path) ?></div>
</div>

<div>$this->data['id'] <?= Html::esc($this->data['id']) ?></div>
<div>$data['id'] <?= Html::esc($data['id'] ?? 'none') ?></div>
<div>$data['val1'] <?= Html::esc($data['val1']) ?></div>