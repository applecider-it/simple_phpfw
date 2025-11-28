<?php

use SFW\Output\Html;
?>

<div style="margin-bottom: 1rem;">
    <label class="app-form-label">Name</label>
    <input type="text" name="name" value="<?= Html::esc($data['name']) ?>" class="app-form-input">
</div>

<div style="margin-bottom: 1rem;">
    <label class="app-form-label">Email</label>
    <input type="text" name="email" value="<?= Html::esc($data['email']) ?>" class="app-form-input">
</div>

<div style="margin-bottom: 1rem;">
    <label class="app-form-label">Password</label>
    <input type="text" name="password" value="<?= Html::esc($data['password']) ?>" class="app-form-input">
</div>

<div style="margin-bottom: 1rem;">
    <label class="app-form-label">Password Confirm</label>
    <input type="text" name="password_confirm" value="<?= Html::esc($data['password_confirm']) ?>" class="app-form-input">
</div>