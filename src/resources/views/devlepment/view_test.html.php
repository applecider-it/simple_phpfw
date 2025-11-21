<?php

use SFW\Output\Html;
?>
<h2>devlepment.view_test</h2>
<div>
    <div>$this->data['id'] <?= Html::esc($this->data['id']) ?></div>
    <div>$data['id'] <?= Html::esc($data['id']) ?></div>
</div>
