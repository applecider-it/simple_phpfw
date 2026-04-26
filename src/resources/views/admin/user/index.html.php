<?php
$this->setLayoutValue('breadcrumbs', ['admin.user.index']);
?>
<h2 class="app-h2">admin.user.index</h2>

<div class="mt-10">
    <div>
        <a href="<?= $this->h($this->route('admin.user.create')) ?>" class="app-btn-primary">
            新規作成
        </a>
    </div>

    <div class="mt-10">
        <?= $this->render('admin.user.partials.search', $params) ?>
    </div>

    <div class="mt-10">
        <?= $this->render('admin.user.partials.list', ['users' => $users]) ?>
    </div>

    <?= $this->render('partials.pagination.paginator', ['paginator' => $paginator]) ?>
</div>