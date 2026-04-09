<?php
$this->setLayoutValue('breadcrumbs', ['admin.user.create']);

$data['exists'] = false;
?>
<h2>📝 admin.user.create</h2>

<div>
    <div>
        <a href="<?= $this->h($this->route('admin.user.index')) ?>">一覧</a>
    </div>

    <?= $this->render('partials.validation.errors', ['errors' => $errors ?? null]) ?>

    <div>
        <form method="POST" action="<?= $this->h($this->route('admin.user.create')) ?>">
            <?= $this->render('partials.form.csrf') ?>
            <?= $this->render('admin.user.partials.form', $data) ?>
            <div>
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</div>