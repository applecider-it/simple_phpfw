<div style="margin-top: 1rem;">
    <label class="app-form-label">Name</label>
    <input type="text" name="name" value="<?= $this->h($name) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'name']) ?>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Email</label>
    <input type="text" name="email" value="<?= $this->h($email) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'email']) ?>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">
        Password
        <?php if ($exists): ?>
            （変更する場合のみ）
        <?php endif; ?>
    </label>
    <input type="password" name="password" value="<?= $this->h($password) ?>" class="app-form-input">
    <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'password']) ?>
</div>

<div style="margin-top: 1rem;">
    <label class="app-form-label">Password Confirm</label>
    <input type="password" name="password_confirm" value="<?= $this->h($password_confirm) ?>" class="app-form-input">
</div>