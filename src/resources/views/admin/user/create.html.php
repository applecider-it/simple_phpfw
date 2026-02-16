<?php

use SFW\Core\Config;
?>
<h2 class="app-h2">📝 admin.user.create</h2>

<div>
    <div style="margin-top: 1rem;">
        <a href="<?= Config::get('adminPrefix') ?>/users" class="app-link-normal">一覧</a>
    </div>

    <?= $this->render('partials.validation.errors', ['errors' => $data['errors'] ?? null]) ?>

    <div style="margin-top: 1rem;">
        <form method="POST" action="<?= Config::get('adminPrefix') ?>/users/create">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('admin.user.partials.form', $data) ?>
            <div style="margin-top: 1rem;">
                <button type="submit" class="app-btn-primary">登録</button>
            </div>
        </form>
    </div>
</div>