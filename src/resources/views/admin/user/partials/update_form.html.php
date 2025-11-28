<?php

use SFW\Output\Html;
?>

<div>
    Name: <input type="text" name="name" value="<?= Html::esc($data['name']) ?>">
</div>

<div>
    Email: <input type="text" name="email" value="<?= Html::esc($data['email']) ?>">
</div>
