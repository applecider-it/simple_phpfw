<?php

use SFW\Output\Html;

?>
<h2>devlepment.validation_test</h2>
<div>
    <div>errors</div>
    <pre><?= Html::esc(print_r($data['errors'], true)) ?></pre>
</div>