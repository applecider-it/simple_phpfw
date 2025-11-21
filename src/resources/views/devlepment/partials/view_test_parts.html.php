<?php

use SFW\Output\Html;
?>
<h3>devlepment.partials.view_test_parts</h3>
<div>$this->data['id'] <?= Html::esc($this->data['id']) ?></div>
<div>$data['id'] <?= Html::esc($data['id'] ?? 'none') ?></div>
<div>$data['val1'] <?= Html::esc($data['val1']) ?></div>