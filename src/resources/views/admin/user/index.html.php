<?php
$this->setLayoutValue('breadcrumbs', ['admin.user.index']);
?>
<h2 class="app-h2">admin.user.index</h2>

<div>
    <div>
        <a href="<?= $this->h($this->route('admin.user.create')) ?>" class="app-btn-primary">
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