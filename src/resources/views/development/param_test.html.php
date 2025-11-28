<?php

use SFW\Output\Html;
?>
<h2 class="app-h2">development.param_test</h2>
<div>
    <div>$data['id'] <?= Html::esc($data['id']) ?></div>
    <div>$data['val1'] <?= Html::esc($data['val1']) ?></div>
</div>
<div style="margin-top: 5rem;">
    <form method="POST" action="/development/param_test/xyz">
        <input type="text" name="val1" value="バリュー１">
        <button type="submit">送信</button>
    </form>
</div>