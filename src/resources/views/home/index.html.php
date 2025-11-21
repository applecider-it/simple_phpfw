<?php

use SFW\Output\Html;
?>
<h2>Home.index</h2>
<div>
    <div>$this->data['id'] <?= Html::esc($this->data['id']) ?></div>
    <div>$data['id'] <?= Html::esc($data['id']) ?></div>
</div>
<div>
    <a href="/test/<?= Html::esc($data['id']) ?>">test</a>
</div>