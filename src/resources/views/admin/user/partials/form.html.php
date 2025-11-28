<?php

use SFW\Output\Html;
?>

<div>
    Name: <input type="text" name="name" value="<?= Html::esc($data['name']) ?>">
</div>

<div>
    Email: <input type="text" name="email" value="<?= Html::esc($data['email']) ?>">
</div>

<div>
    Password: <input type="text" name="password" value="<?= Html::esc($data['password']) ?>">
</div>

<div>
    Password Confirm: <input type="text" name="password_confirm" value="<?= Html::esc($data['password_confirm']) ?>">
</div>
