<div>
    <label>Name</label>
    <div>
        <input type="text" name="name" value="<?= $this->h($name) ?>">
        <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'name']) ?>
    </div>
</div>

<div>
    <label>Email</label>
    <div>
        <input type="text" name="email" value="<?= $this->h($email) ?>">
        <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'email']) ?>
    </div>
</div>

<div>
    <label>
        Password
        <?php if ($exists): ?>
            （変更する場合のみ）
        <?php endif; ?>
    </label>
    <div>
        <input type="password" name="password" value="<?= $this->h($password) ?>">
        <?= $this->render('partials.validation.error', ['errors' => $errors ?? null, 'attribute' => 'password']) ?>
    </div>
</div>

<div>
    <label>Password Confirm</label>
    <div>
        <input type="password" name="password_confirm" value="<?= $this->h($password_confirm) ?>">
    </div>
</div>