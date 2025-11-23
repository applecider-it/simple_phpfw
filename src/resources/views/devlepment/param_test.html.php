<?php

use SFW\Output\Html;
?>
<h2>devlepment.param_test</h2>
<div>
    <div>$data['id'] <?= Html::esc($data['id']) ?></div>
    <div>$data['val1'] <?= Html::esc($data['val1']) ?></div>
</div>