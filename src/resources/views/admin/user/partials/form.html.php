<?php

use function SFW\Helpers\html_esc as h;
?>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Name</label>
    <input type="text" name="name" value="<?= h($data['name']) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $data['errors'] ?? null, 'attribute' => 'name']) ?>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Email</label>
    <input type="text" name="email" value="<?= h($data['email']) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $data['errors'] ?? null, 'attribute' => 'email']) ?>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">
        Password
        <?php if ($data['exists']): ?>
            （変更する場合のみ）
        <?php endif; ?>
    </label>
    <input type="password" name="password" value="<?= h($data['password']) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $data['errors'] ?? null, 'attribute' => 'password']) ?>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Password Confirm</label>
    <input type="password" name="password_confirm" value="<?= h($data['password_confirm']) ?>" class="app-form-input">
</div>