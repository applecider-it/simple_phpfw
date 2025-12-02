<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2 class="app-h2">auth.session.login</h2>

<?= $this->render('partials.message.flash') ?>

<div>
    <div style="margin-top: 1rem;">
        <form method="POST" action="/login">
            <?= $this->render('partials.form.csrf') ?>
            <div style="margin-top: 1rem;">
                <label class="app-form-label">Email</label>
                <input type="text" name="email" value="<?= Html::esc($data['email']) ?>" class="app-form-input">
            </div>

            <div style="margin-top: 1rem;">
                <label class="app-form-label">Password</label>
                <input type="text" name="password" value="<?= Html::esc($data['password']) ?>" class="app-form-input">
            </div>
            <div style="margin-top: 1rem;">
                <button type="submit" class="app-btn-primary">ログイン</button>
            </div>
        </form>
    </div>
</div>