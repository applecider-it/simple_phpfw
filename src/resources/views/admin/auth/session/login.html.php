<h2 class="app-h2">admin.auth.session.login</h2>

<div class="mt-10">
    <?= $this->render('partials.message.flash') ?>

    <form method="POST" action="<?= $this->h($this->route('admin.login')) ?>">
        <?= $this->render('partials.form.csrf') ?>
        <div>
            <label class="app-form-label">Email</label>
            <input type="text" name="email" value="<?= $this->h($email) ?>" class="app-form-input">
        </div>

        <div class="mt-4">
            <label class="app-form-label">Password</label>
            <input type="password" name="password" value="<?= $this->h($password) ?>" class="app-form-input">
        </div>

        <div class="mt-10">
            <button type="submit" class="app-btn-primary">ログイン</button>
        </div>
    </form>
</div>