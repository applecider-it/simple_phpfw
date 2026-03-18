<?php

use SFW\Output\View\Layout;
use function SFW\Helpers\route;

$data[Layout::KEY_LAYOUT_OPTIONS]->breadcrumbs = ['admin.users.index'];
?>
<h2 class="app-h2">admin.user.index</h2>

<div>
    <div>
        <a href="{{ route('admin.users.create') }}" class="app-btn-primary">
            新規作成
        </a>
    </div>

    <div style="margin-top: 1rem;">
        <?= $this->render('admin.user.partials.search', $params) ?>
    </div>

    <?= $this->render('partials.pagination.paginator', ['paginator' => $paginator]) ?>

    <?= $this->render('admin.user.partials.list', ['users' => $users]) ?>

    <?= $this->render('partials.pagination.paginator', ['paginator' => $paginator]) ?>
</div>