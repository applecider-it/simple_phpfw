<?php

use SFW\Core\Config;
use function SFW\Helpers\route;

$adminPrefix = Config::get('app.adminPrefix');

$return['breadcrumbs'] = ['admin.users.index'];
?>
<h2 class="app-h2">admin.user.index</h2>

<div>
    <div>
        <a href="<?= route('admin.users.create') ?>" class="app-btn-primary">
            新規作成
        </a>
    </div>

    <div style="margin-top: 1rem;">
        <?= $this->render('admin.user.partials.search', $data['params']) ?>
    </div>

    <?= $this->render('partials.pagination.paginator', ['paginator' => $data['paginator']]) ?>

    <?= $this->render('admin.user.partials.list', ['users' => $data['users']]) ?>

    <?= $this->render('partials.pagination.paginator', ['paginator' => $data['paginator']]) ?>
</div>