<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2 class="app-h2">📝 admin.user.create</h2>

<div>
    <div style="margin-bottom: 1rem;">
        <a href="<?= Config::get('adminPrefix') ?>/users" class="app-normal-link">一覧</a>
    </div>

    <?= $this->render('partials.validation.errors', ['errors' => $data['errors'] ?? null]) ?>

    <div>
        <form method="POST">
            <?= $this->render('admin.user.partials.form', $data) ?>
            <div>
                <button type="submit" class="app-btn-primary">登録</button>
            </div>
        </form>
    </div>
</div>