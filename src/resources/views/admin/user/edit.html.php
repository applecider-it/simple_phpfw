<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2 class="app-h2">📝 admin.user.edit</h2>

<div>
    <div style="margin-top: 1rem;">
        <a href="<?= Config::get('adminPrefix') ?>/users" class="app-link-normal">一覧</a>
    </div>

    <?= $this->render('partials.validation.errors', ['errors' => $data['errors'] ?? null]) ?>

    <?= $this->render('partials.message.flash') ?>

    <div style="margin-top: 1rem;">
        <form method="POST" action="<?= Config::get('adminPrefix') ?>/users/<?= $data['id'] ?>/edit">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('admin.user.partials.update_form', $data) ?>
            <div style="margin-top: 1rem;">
                <button type="submit" class="app-btn-primary">更新</button>
            </div>
        </form>
    </div>

    <div style="margin-top: 3rem;">
        <?= $this->render('admin.user.partials.update_ctrl', $data) ?>
    </div>
</div>