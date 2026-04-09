<h2>admin.auth.session.login</h2>

<?= $this->render('partials.message.flash') ?>

<div>
    <div>
        <form method="POST" action="<?= $this->h($this->route('admin.login')) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <div>
                <label>Email</label>
                <input type="text" name="email" value="<?= $this->h($email) ?>">
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" value="<?= $this->h($password) ?>">
            </div>
            <div>
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>