<?php

use function SFW\Helpers\html_esc as h;
use function SFW\Helpers\route;
?>
<h2 class="app-h2">admin.auth.session.login</h2>

<?= $this->render('partials.message.flash') ?>

<div>
    <div style="margin-top: 1rem;">
        <form method="POST" action="<?= route('admin.login') ?>">
            <?= $this->render('partials.form.csrf') ?>
            <div style="margin-top: 1rem;">
                <label class="app-form-label">Email</label>
                <input type="text" name="email" value="<?= h($data['email']) ?>" class="app-form-input">
            </div>

            <div style="margin-top: 1rem;">
                <label class="app-form-label">Password</label>
                <input type="password" name="password" value="<?= h($data['password']) ?>" class="app-form-input">
            </div>
            <div style="margin-top: 1rem;">
                <button type="submit" class="app-btn-primary">ログイン</button>
            </div>
        </form>
    </div>
</div>