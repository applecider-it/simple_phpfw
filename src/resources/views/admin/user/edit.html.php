<?php

use SFW\Output\Html;
use SFW\Core\Config;
?>
<h2>admin.user.edit</h2>

<div>
    <div>
        <a href="<?= Config::get('adminPrefix') ?>/users">一覧</a>
    </div>

    <?= $this->render('partials.validation.errors', ['errors' => $data['errors'] ?? null]) ?>

    <div>
        <form method="POST">
            <?= $this->render('admin.user.partials.update_form', $data) ?>
            <div>
                <button type="submit">更新</button>
            </div>
        </form>
    </div>
</div>