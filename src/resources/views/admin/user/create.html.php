<?php
$this->setLayoutValue('breadcrumbs', ['admin.user.create']);

$data['exists'] = false;
?>
<h2 class="app-h2">📝 admin.user.create</h2>

<div>
    <div style="margin-top: 1rem;">
        <a href="<?= $this->h($this->route('admin.user.index')) ?>" class="app-link-normal">一覧</a>
    </div>

    <?= $this->render('partials.validation.errors', ['errors' => $errors ?? null]) ?>

    <div style="margin-top: 1rem;">
        <form method="POST" action="<?= $this->h($this->route('admin.user.create')) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('admin.user.partials.form', $data) ?>
            <div style="margin-top: 1rem;">
                <button type="submit" class="app-btn-primary">登録</button>
            </div>
        </form>
    </div>
</div>