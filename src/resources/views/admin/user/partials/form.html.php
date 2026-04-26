<div>
    <label class="app-form-label">Name</label>
    <div>
        <input type="text" name="name" value="<?= $this->h($name) ?>" class="app-form-input">
        <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'name']) ?>
    </div>
</div>

<div class="mt-4">
    <label class="app-form-label">Email</label>
    <div>
        <input type="text" name="email" value="<?= $this->h($email) ?>" class="app-form-input">
        <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'email']) ?>
    </div>
</div>

<div class="mt-4">
    <label class="app-form-label">
        Password
        <?php if ($exists): ?>
            （変更する場合のみ）
        <?php endif; ?>
    </label>
    <div>
        <input type="password" name="password" value="<?= $this->h($password) ?>" class="app-form-input">
        <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'password']) ?>
    </div>
</div>

<div class="mt-4">
    <label class="app-form-label">Password Confirm</label>
    <div>
        <input type="password" name="password_confirm" value="<?= $this->h($password_confirm) ?>" class="app-form-input">
    </div>
</div>